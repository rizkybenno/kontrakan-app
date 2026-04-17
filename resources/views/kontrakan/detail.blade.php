@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    <!-- Gambar -->
    <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994"
         class="w-full h-64 object-cover rounded-lg mb-6">

    <!-- Info -->
    <h2 class="text-2xl font-bold text-gray-800 mb-2">
        Kontrakan Nyaman di Cimahpar
    </h2>

    <p class="text-amber-700 text-xl font-bold mb-4">
        Rp 800.000 / bulan
    </p>

    <p class="text-gray-600 mb-4">
        Kontrakan nyaman dengan fasilitas lengkap, lokasi strategis,
        cocok untuk keluarga maupun mahasiswa.
    </p>

    <!-- Fasilitas -->
    <div class="mb-6">
        <h3 class="font-semibold text-gray-800 mb-2">Fasilitas:</h3>
        <ul class="list-disc list-inside text-gray-600">
            <li>Kamar tidur</li>
            <li>Kamar mandi</li>
            <li>Dapur</li>
            <li>Listrik</li>
        </ul>
    </div>

    <!-- Tombol -->
    <a href="/booking"
       class="bg-amber-700 text-white px-6 py-2 rounded hover:bg-amber-800">
        Booking Sekarang
    </a>

</div>

@endsection