<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kontrakan;
use App\Models\Kamar;

class KontrakanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | 🌐 LIST KONTRAKAN
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $kontrakan = Kontrakan::where('status_pengajuan', 'approved')

            ->when($request->filled('search'), function ($query) use ($request) {

                $query->where(function ($q) use ($request) {

                    $q->where('nama', 'like', '%' . $request->search . '%')
                      ->orWhere('alamat', 'like', '%' . $request->search . '%')
                      ->orWhere('wilayah', 'like', '%' . $request->search . '%');

                });

            })

            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | 🔥 CEK USER SUDAH PUNYA KONTRAKAN
        |--------------------------------------------------------------------------
        */

        $punyaKontrakan = false;

        if (auth()->check()) {

            $punyaKontrakan = Kontrakan::where(
                'user_id',
                auth()->id()
            )->exists();
        }

        return view('kontrakan.index', compact(
            'kontrakan',
            'punyaKontrakan'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | 🏠 KONTRAKAN SAYA
    |--------------------------------------------------------------------------
    */
    public function myKontrakan()
    {
        $kontrakan = Kontrakan::where(
            'user_id',
            auth()->id()
        )->first();

        return view('kontrakan.kontrakansaya', compact(
            'kontrakan'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | 🔍 DETAIL KONTRAKAN
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $kontrakan = Kontrakan::with('kamars')

            ->where('status_pengajuan', 'approved')

            ->findOrFail($id);

        return view('kontrakan.detail', compact(
            'kontrakan'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | 🛏 DETAIL KAMAR
    |--------------------------------------------------------------------------
    */
    public function detailKamar($kontrakanId, $kamarId)
    {
        $kontrakan = Kontrakan::findOrFail($kontrakanId);

        $kamar = Kamar::where('kontrakan_id', $kontrakanId)

            ->where('id', $kamarId)

            ->firstOrFail();

        return view('kontrakan.detailkamar', compact(
            'kontrakan',
            'kamar'
        ));
    }


    /*
|--------------------------------------------------------------------------
| ✏️ FORM EDIT KONTRAKAN USER
|--------------------------------------------------------------------------
*/
public function editUserKontrakan()
{
    $kontrakan = Kontrakan::with('kamars')
        ->where('user_id', auth()->id())
        ->firstOrFail();

    return view(
        'kontrakan.editkontrakanuser',
        compact('kontrakan')
    );
}

/*
|--------------------------------------------------------------------------
| 💾 UPDATE KONTRAKAN USER
|--------------------------------------------------------------------------
*/
public function updateUserKontrakan(Request $request)
{
    $kontrakan = Kontrakan::where('user_id', auth()->id())
        ->firstOrFail();

    $data = $request->validate([

        'nama'         => 'required|string|max:255',
        'alamat'       => 'required',
        'wilayah'      => 'required|string|max:255',

        'harga'        => 'required|numeric|min:0',
        'deskripsi'    => 'nullable|string',

        'fotos.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        // kamar
        'kamars' => 'required|array|min:1',

        'kamars.*.nama_kamar' => 'required|string|max:255',
        'kamars.*.harga' => 'nullable|numeric|min:0',
        'kamars.*.status'     => 'required|in:tersedia,dibooking,terisi',
        'kamars.*.deskripsi'  => 'nullable|string',
    ]);

    /*
    |--------------------------------------------------------------------------
    | 📷 Upload Foto Baru (opsional)
    |--------------------------------------------------------------------------
    */

    $fotos = $kontrakan->fotos ?? [];

    if ($request->hasFile('fotos')) {

        $fotos = [];

        foreach ($request->file('fotos') as $index => $foto) {

            $path = $foto->store('kontrakan', 'public');

            $fotos[] = [
                'path' => $path,
                'is_cover' => $index === 0
            ];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | 💾 Update Kontrakan
    |--------------------------------------------------------------------------
    */

    $kontrakan->update([

        'nama'         => $data['nama'],
        'alamat'       => $data['alamat'],
        'wilayah'      => $data['wilayah'],

        'jumlah_kamar' => count($data['kamars']),

        'harga'        => $data['harga'],
        'deskripsi'    => $data['deskripsi'] ?? null,

        'fotos' => $fotos,

        // setelah edit wajib review ulang admin
        'status_pengajuan' => 'pending',
    ]);

    /*
    |--------------------------------------------------------------------------
    | 🛏 UPDATE KAMAR
    |--------------------------------------------------------------------------
    */

    // hapus kamar lama
    Kamar::where('kontrakan_id', $kontrakan->id)->delete();

    // simpan ulang
    foreach ($data['kamars'] as $kamar) {

        Kamar::create([

            'kontrakan_id' => $kontrakan->id,

            'nama_kamar' => $kamar['nama_kamar'],
            'harga'      => $kamar['harga'],
            'status'     => $kamar['status'],
            'deskripsi'  => $kamar['deskripsi'] ?? null,
        ]);
    }

    return redirect()
        ->route('kontrakan.saya')
        ->with(
            'success',
            'Kontrakan berhasil diupdate dan menunggu verifikasi admin.'
        );
}

    /*
    |--------------------------------------------------------------------------
    | 🏠 HOME / REKOMENDASI
    |--------------------------------------------------------------------------
    */
    public function home()
    {
        $rekomendasi = Kontrakan::where(
                'status_pengajuan',
                'approved'
            )

            ->inRandomOrder()

            ->take(6)

            ->get();

        return view('dashboard', compact(
            'rekomendasi'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | 📄 FORM PENGAJUAN
    |--------------------------------------------------------------------------
    */
    public function pengajuan()
    {
        /*
        |--------------------------------------------------------------------------
        | OPTIONAL SAFETY
        |--------------------------------------------------------------------------
        */

        if (auth()->check()) {

            $exists = Kontrakan::where(
                'user_id',
                auth()->id()
            )->exists();

            if ($exists) {

                return redirect('/kontrakan')

                    ->with(
                        'success',
                        'Kamu sudah memiliki kontrakan.'
                    );
            }
        }

        return view('kontrakan.pengajuankontrakan');
    }

    /*
    |--------------------------------------------------------------------------
    | 💾 SIMPAN PENGAJUAN KONTRAKAN
    |--------------------------------------------------------------------------
    */
    public function storePengajuan(Request $request)
    {
        $data = $request->validate([

            'nama'         => 'required|string|max:255',
            'alamat'       => 'required',
            'wilayah'      => 'required|string|max:255',

            'harga'        => 'required|numeric|min:0',
            'deskripsi'    => 'nullable|string',

            'fotos.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            /*
            |--------------------------------------------------------------------------
            | 🛏 VALIDASI KAMAR
            |--------------------------------------------------------------------------
            */

            'kamars' => 'required|array|min:1',

            'kamars.*.nama_kamar'
                => 'required|string|max:255',

            'kamars.*.harga'
    => 'nullable|numeric|min:0',

            'kamars.*.status'
                => 'required|in:tersedia,dibooking,terisi',

            'kamars.*.deskripsi'
                => 'nullable|string',

        ]);

        $fotos = [];

        /*
        |--------------------------------------------------------------------------
        | 📷 UPLOAD FOTO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('fotos')) {

            foreach ($request->file('fotos') as $index => $foto) {

                $path = $foto->store(
                    'kontrakan',
                    'public'
                );

                $fotos[] = [

                    'path' => $path,

                    'is_cover' => $index === 0

                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 💾 SIMPAN KONTRAKAN
        |--------------------------------------------------------------------------
        */

        $kontrakan = Kontrakan::create([

            'user_id' => auth()->id(),

            'nama'         => $data['nama'],
            'alamat'       => $data['alamat'],
            'wilayah'      => $data['wilayah'],

            // otomatis dari jumlah kamar
            'jumlah_kamar' => count($data['kamars']),

            // harga utama
            'harga'        => $data['harga'],

            'deskripsi'    => $data['deskripsi'] ?? null,

            'fotos' => $fotos,

            'status_pengajuan' => 'pending',

            'status' => 'available',

        ]);

        /*
        |--------------------------------------------------------------------------
        | 🛏 SIMPAN DETAIL KAMAR
        |--------------------------------------------------------------------------
        */

        foreach ($data['kamars'] as $kamar) {

            Kamar::create([

                'kontrakan_id' => $kontrakan->id,

                'nama_kamar' => $kamar['nama_kamar'],

                'harga' => $kamar['harga'],

                'status' => $kamar['status'],

                'deskripsi' => $kamar['deskripsi'] ?? null,

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ✅ REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect('/kontrakan')

            ->with(
                'success',
                'Pengajuan kontrakan berhasil dikirim dan menunggu verifikasi admin.'
            );
    }
}