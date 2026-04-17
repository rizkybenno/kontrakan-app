@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-6">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Form Booking Kontrakan
    </h2>

    <p class="text-gray-500 mb-4">
    Anda akan memesan: <span class="font-semibold text-amber-700">Kontrakan Nyaman</span>
</p>

    <!-- Form -->
    <form>

        <!-- Nama -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" 
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-600">
        </div>

        <!-- No HP -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">No. HP</label>
            <input type="text" 
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-600">
        </div>

        <!-- Tanggal -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Tanggal Mulai Sewa</label>
            <input type="date" 
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-600">
        </div>

        <!-- Durasi -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Durasi Sewa</label>
            <select class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-600">
                <option>1 Bulan</option>
                <option>3 Bulan</option>
                <option>6 Bulan</option>
                <option>1 Tahun</option>
            </select>
        </div>

        <!-- Pembayaran -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Metode Pembayaran</label>
            <select class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-600">
                <option>Transfer Bank</option>
                <option>QRIS</option>
                <option>Tunai</option>
            </select>
        </div>

        <!-- Tombol -->
        <button type="submit"
            class="w-full bg-amber-700 text-white py-2 rounded-lg hover:bg-amber-800 transition font-semibold">
            Booking Sekarang
        </button>

    </form>

</div>

@endsection