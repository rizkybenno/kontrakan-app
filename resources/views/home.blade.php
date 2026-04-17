@extends('layouts.app')

@section('content')

<!-- HERO / CAPTION -->
<div class="text-center py-12 px-4 bg-black/40 rounded mb-8">
    <h2 class="text-2xl md:text-3xl font-bold mb-3 text-white">
        Temukan Kontrakan Nyaman Impianmu di Cimahpar 🏠
    </h2>
    <p class="text-sm md:text-base text-gray-200">
        Pilih hunian terbaik dengan harga terjangkau, fasilitas lengkap, dan lokasi strategis.
    </p>

    <!-- Search -->
    <div class="mt-6 max-w-xl mx-auto flex bg-white rounded overflow-hidden">
        <input type="text" placeholder="Cari kontrakan..."
               class="w-full p-3 outline-none text-black text-sm">
        <button class="bg-gray-800 text-white px-4 text-sm hover:bg-gray-900">
            Cari
        </button>
    </div>
</div>

@php
$kontrakans = [
    ['nama' => 'Kontrakan Pak Riko', 'lokasi' => 'Lawanggintung, Bogor Selatan', 'harga' => 850000],
    ['nama' => 'Kontrakan Ibu Ayu', 'lokasi' => 'Ranggamekar, Bogor Selatan', 'harga' => 900000],
    ['nama' => 'Kontrakan Henri HS', 'lokasi' => 'Ranggamekar, Bogor Selatan', 'harga' => 750000],
    ['nama' => 'Kontrakan BK', 'lokasi' => 'Mulyaharja, Bogor Selatan', 'harga' => 650000],
    ['nama' => 'Kontrakan Pak Ayi', 'lokasi' => 'Ranggamekar, Bogor Selatan', 'harga' => 600000],
    ['nama' => 'Kontrakan Melati', 'lokasi' => 'Baranangsiang, Bogor Timur', 'harga' => 1000000],
    ['nama' => 'Kontrakan BN', 'lokasi' => 'Baranangsiang, Bogor Timur', 'harga' => 1200000],
    ['nama' => 'Kontrakan Indah Berkah', 'lokasi' => 'Ranggamekar, Bogor Selatan', 'harga' => 700000],
    ['nama' => 'Kontrakan Ambar', 'lokasi' => 'Ranggamekar, Bogor Selatan', 'harga' => 650000],
    ['nama' => 'Kontrakan Banteng', 'lokasi' => 'Katulampa, Bogor Timur', 'harga' => 900000],
];

// urutkan dari termurah
usort($kontrakans, function($a, $b) {
    return $a['harga'] <=> $b['harga'];
});

// ambil 6 terbaik
$limit = 6;
$rekomendasi = array_slice($kontrakans, 0, $limit);
@endphp

<!-- REKOMENDASI -->
<div class="bg-black/40 p-4 rounded mb-6">
    <h3 class="text-xl font-bold text-white">
        Rekomendasi
    </h3>
</div>

<div class="grid grid-cols-3 gap-6">

@foreach($rekomendasi as $k)
<div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden transition">

    <!-- Gambar -->
    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"
         class="w-full h-40 object-cover hover:scale-105 transition duration-300">

    <div class="p-4">
        <h4 class="font-semibold text-gray-800">
            {{ $k['nama'] }}
        </h4>

        <p class="text-sm text-gray-500">
            {{ $k['lokasi'] }}
        </p>

        <p class="text-amber-700 font-bold mt-2">
            Rp {{ number_format($k['harga']) }} / bulan
        </p>

        <a href="/kontrakan/detail"
           class="block bg-amber-700 text-white text-center mt-3 py-2 rounded hover:bg-amber-800 transition">
            Lihat Detail
        </a>
    </div>

</div>
@endforeach

</div>

@endsection