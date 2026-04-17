@extends('layouts.app')

@section('content')

<!-- Judul -->
<div class="bg-black/40 p-4 rounded mb-6">
    <h2 class="text-2xl font-bold text-white">
        Daftar Kontrakan
    </h2>
</div>

@php
$kontrakans = [
    [
        'nama' => 'Kontrakan Pak Riko',
        'lokasi' => 'Lawanggintung, Bogor Selatan',
        'harga' => 850000
    ],
    [
        'nama' => 'Kontrakan Ibu Ayu',
        'lokasi' => 'Ranggamekar, Bogor Selatan',
        'harga' => 900000
    ],
    [
        'nama' => 'Kontrakan Henri HS',
        'lokasi' => 'Ranggamekar, Bogor Selatan',
        'harga' => 750000
    ],
    [
        'nama' => 'Kontrakan BK',
        'lokasi' => 'Mulyaharja, Bogor Selatan',
        'harga' => 650000
    ],
    [
        'nama' => 'Kontrakan Pak Ayi',
        'lokasi' => 'Ranggamekar, Bogor Selatan',
        'harga' => 600000
    ],
    [
        'nama' => 'Kontrakan Melati',
        'lokasi' => 'Baranangsiang, Bogor Timur',
        'harga' => 1000000
    ],
    [
        'nama' => 'Kontrakan BN',
        'lokasi' => 'Baranangsiang, Bogor Timur',
        'harga' => 1200000
    ],
    [
        'nama' => 'Kontrakan Indah Berkah',
        'lokasi' => 'Ranggamekar, Bogor Selatan',
        'harga' => 700000
    ],
    [
        'nama' => 'Kontrakan Ambar',
        'lokasi' => 'Ranggamekar, Bogor Selatan',
        'harga' => 650000
    ],
    [
        'nama' => 'Kontrakan Banteng',
        'lokasi' => 'Katulampa, Bogor Timur',
        'harga' => 900000
    ],
];
@endphp

<!-- Grid -->
<div class="grid grid-cols-3 gap-6">

@foreach($kontrakans as $k)
<div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden transition">

    <!-- Gambar -->
    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"
         class="w-full h-40 object-cover">

    <div class="p-4">
        <!-- Nama -->
        <h3 class="font-semibold text-gray-800">
            {{ $k['nama'] }}
        </h3>

        <!-- Lokasi -->
        <p class="text-sm text-gray-500">
            {{ $k['lokasi'] }}
        </p>

        <!-- Harga -->
        <p class="text-amber-700 font-bold mt-2">
            Rp {{ number_format($k['harga']) }} / bulan
        </p>

        <!-- Tombol -->
        <a href="/kontrakan/detail"
           class="block bg-amber-700 text-white text-center mt-3 py-2 rounded hover:bg-amber-800 transition">
            Lihat Detail
        </a>
    </div>

</div>
@endforeach

</div>

@endsection