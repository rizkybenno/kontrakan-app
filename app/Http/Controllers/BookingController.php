<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Kontrakan;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * 📝 FORM BOOKING
     */
    public function index($id)
    {
        $kontrakan = Kontrakan::findOrFail($id);

        $bookings = Booking::where('kontrakan_id', $id)
            ->latest()
            ->get();

        return view('booking.booking', compact('kontrakan', 'bookings'));
    }

    /**
     * 💾 SIMPAN BOOKING + REDIRECT KE PEMBAYARAN
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'kontrakan_id'    => 'required|exists:kontrakans,id',
        'no_hp'           => 'required|string|max:15',
        'tanggal_mulai'   => 'required|date',
        'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        'metode'          => 'required|in:bca,bsi,qris',
    ]);

    $kontrakan = Kontrakan::findOrFail($data['kontrakan_id']);

    $mulai = \Carbon\Carbon::parse($data['tanggal_mulai']);
$selesai = \Carbon\Carbon::parse($data['tanggal_selesai']);

// HITUNG TOTAL HARI
$totalHari = $mulai->diffInDays($selesai);

// KONVERSI KE BULAN
// < 1 bulan = tetap 1 bulan
// lebih sedikit pun dibulatkan ke atas
$lamaSewa = ceil($totalHari / 30);

// MINIMAL 1 BULAN
if ($lamaSewa < 1) {
    $lamaSewa = 1;
}

    // TOTAL
    $total = $kontrakan->harga * $lamaSewa;

    // SIMPAN BOOKING
    $booking = Booking::create([

        'user_id'            => auth()->id(),
        'kontrakan_id'       => $data['kontrakan_id'],
        'no_hp'              => $data['no_hp'],

        'tanggal_mulai'      => $data['tanggal_mulai'],
        'tanggal_selesai'    => $data['tanggal_selesai'],

        'lama_sewa'          => $lamaSewa,

        'metode_pembayaran'  => $data['metode'],

        'total_harga'        => $total,

        'status'             => 'pending',
    ]);

    return redirect()
        ->route('booking.pembayaran', $booking->id);
}

    /**
     * 💳 HALAMAN PEMBAYARAN (DI DALAM BOOKING CONTROLLER)
     */
    public function pembayaran($id)
    {
        $booking = Booking::with('kontrakan')->findOrFail($id);

        $metode = $booking->metode_pembayaran;

        return view('booking.pembayaran', compact('booking', 'metode'));
    }

    public function uploadBukti(Request $request, $id)
{
    $request->validate([
        'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $booking = Booking::findOrFail($id);

    // upload file
    $path = $request->file('bukti')
        ->store('bukti_pembayaran', 'public');

    // simpan ke database
    $booking->update([
        'bukti_pembayaran' => $path,
        'status' => 'pending',
    ]);

    return back()->with(
        'success',
        'Bukti pembayaran berhasil diupload.'
    );
}
}