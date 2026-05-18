<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * 💳 HALAMAN PEMBAYARAN
     */
    public function create($id)
    {
        // Ambil booking + relasi kontrakan
        $booking = Booking::with('kontrakan')->findOrFail($id);

        return view('booking.metodepembayaran', compact('booking'));
    }


    /**
     * 💾 SIMPAN PEMBAYARAN
     */
    public function store(Request $request)
    {
        // ✅ VALIDASI
        $data = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'metode' => 'required|string',
            'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🔥 AMBIL BOOKING DARI DATABASE (JANGAN PERCAYA INPUT USER)
        $booking = Booking::with('kontrakan')->findOrFail($data['booking_id']);

        // 🔥 HITUNG JUMLAH OTOMATIS (ANTI MANIPULASI)
        $jumlah = $booking->kontrakan->harga;

        // 📸 UPLOAD BUKTI
        $path = $request->file('bukti')->store('bukti', 'public');

        // 💾 SIMPAN PEMBAYARAN
        Pembayaran::create([
            'booking_id' => $booking->id,
            'jumlah' => $jumlah,
            'metode' => $data['metode'],
            'bukti_pembayaran' => $path,
            'status' => 'pending'
        ]);

        // 🔥 UPDATE STATUS BOOKING
        $booking->update([
            'status' => 'menunggu_verifikasi'
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Pembayaran berhasil dikirim, menunggu verifikasi admin');
    }
}