<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kontrakan;
use App\Models\ReviewReport;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | 👤 USER MANAGEMENT
    |--------------------------------------------------------------------------
    */
    public function users()
    {
        $users = User::latest()->get();

        return view('admin.adminmanageuser', compact('users'));
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | 🏠 KONTRAKAN CRUD (ADMIN ONLY)
    |--------------------------------------------------------------------------
    */


    public function index()
{
    $kontrakan = Kontrakan::latest()->get();

    return view('admin.kontrakan.index', compact('kontrakan'));
}

    public function create()
    {
        return view('admin.kontrakan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'wilayah' => 'required',
            'harga' => 'required|numeric',
            'jumlah_kamar' => 'required|integer|min:1',
            'deskripsi' => 'nullable',
            'fotos.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $paths = [];

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $index => $file) {
                $paths[] = [
                    'path' => $file->store('kontrakan', 'public'),
                    'is_cover' => $index === 0
                ];
            }
        }

        $data['fotos'] = $paths;

        Kontrakan::create($data);

        return redirect()->route('admin.panel')
            ->with('success', 'Kontrakan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kontrakan = Kontrakan::findOrFail($id);

        return view('admin.kontrakan.edit', compact('kontrakan'));
    }

    public function update(Request $request, $id)
    {
        $kontrakan = Kontrakan::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'wilayah' => 'required',
            'harga' => 'required|numeric',
            'jumlah_kamar' => 'required|integer|min:1',
            'deskripsi' => 'nullable',
            'fotos.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fotos = is_array($kontrakan->fotos)
            ? $kontrakan->fotos
            : [];

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $file) {
                $fotos[] = [
                    'path' => $file->store('kontrakan', 'public'),
                    'is_cover' => count($fotos) === 0
                ];
            }
        }

        $data['fotos'] = $fotos;

        $kontrakan->update($data);

        return redirect()->route('admin.panel')
            ->with('success', 'Kontrakan berhasil diupdate');
    }

    public function destroy($id)
    {
        $kontrakan = Kontrakan::findOrFail($id);

        if ($kontrakan->fotos) {
            foreach ($kontrakan->fotos as $foto) {
                $path = is_array($foto) ? $foto['path'] : $foto;
                Storage::disk('public')->delete($path);
            }
        }

        $kontrakan->delete();

        return back()->with('success', 'Kontrakan berhasil dihapus');
    }



    public function deleteFoto($id, $index)
{
    $kontrakan = Kontrakan::findOrFail($id);

    $fotos = $kontrakan->fotos ?? [];

    if (isset($fotos[$index])) {

        Storage::disk('public')->delete($fotos[$index]['path']);

        unset($fotos[$index]);

        $fotos = array_values($fotos);

        if (count($fotos) > 0) {
            $fotos[0]['is_cover'] = true;
        }

        $kontrakan->update([
            'fotos' => $fotos
        ]);
    }

    return back()->with('success', 'Foto berhasil dihapus');
}




    public function setCover($id, Request $request)
    {
        $kontrakan = Kontrakan::findOrFail($id);

        $index = $request->index;
        $fotos = $kontrakan->fotos ?? [];

        if (isset($fotos[$index])) {
            foreach ($fotos as &$foto) {
                $foto['is_cover'] = false;
            }

            $fotos[$index]['is_cover'] = true;

            $kontrakan->update(['fotos' => $fotos]);
        }

        return back()->with('success', 'Cover berhasil diubah');
    }

    /*
    |--------------------------------------------------------------------------
    | 🚨 REPORT MANAGEMENT
    |--------------------------------------------------------------------------
    */
    public function reports()
    {
        $reports = ReviewReport::with(['review.user', 'user'])
            ->latest()
            ->get();

        return view('admin.reportmanagement', compact('reports'));
    }

    public function deleteReport($id)
    {
        $report = ReviewReport::findOrFail($id);
        $report->delete();

        return back()->with('success', 'Report berhasil dihapus');
    }


    public function approve($id)
{
    $kontrakan = Kontrakan::findOrFail($id);

    $kontrakan->update([
        'status_pengajuan' => 'approved'
    ]);

    return back()->with('success', 'Kontrakan disetujui');
}

public function approveBooking($id)
{
    $booking = Booking::with('kontrakan')->findOrFail($id);

    // approve booking
    $booking->update([
        'status' => 'approved',
    ]);

    // format nomor
    $nomor = $booking->no_hp;

    if (substr($nomor, 0, 1) == '0') {
        $nomor = '62' . substr($nomor, 1);
    }

    // pesan whatsapp
    $pesan = urlencode(
        "Halo, booking kontrakan Anda telah DISETUJUI.\n\n" .
        "Kontrakan: {$booking->kontrakan->nama}\n" .
        "Lama sewa: {$booking->lama_sewa} bulan\n" .
        "Total pembayaran: Rp " .
        number_format($booking->total_harga, 0, ',', '.') .
        "\n\nTerima kasih."
    );

    $waLink = "https://wa.me/{$nomor}?text={$pesan}";

    return redirect()
        ->route('admin.booking.index')
        ->with('success', 'Booking berhasil disetujui.')
        ->with('wa_link', $waLink);
}

public function reject($id)
{
    $kontrakan = Kontrakan::findOrFail($id);

    $kontrakan->update([
        'status_pengajuan' => 'rejected'
    ]);

    return back()->with('success', 'Kontrakan ditolak');
}

public function booking()
{
    $bookings = \App\Models\Booking::with([
        'user',
        'kontrakan'
    ])->latest()->get();

    return view(
        'admin.adminkelolabooking',
        compact('bookings')
    );
}
}