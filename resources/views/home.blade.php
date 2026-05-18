@extends('layouts.app')

@section('content')

<!-- HERO -->
<div class="text-center py-12 px-4 bg-amber-700 rounded mb-8 text-white">
    <h2 class="text-2xl md:text-3xl font-bold mb-3">
        Temukan Kontrakan Nyaman Impianmu 🏠
    </h2>
    <p class="text-sm md:text-base">
        Pilih hunian terbaik dengan harga terjangkau, fasilitas lengkap, dan lokasi strategis.
    </p>

    <!-- Search -->
    <form action="/kontrakan" method="GET" class="mt-6 max-w-xl mx-auto flex bg-white rounded overflow-hidden">
    
    <input type="text" name="search" placeholder="Cari kontrakan..."
           class="w-full p-3 outline-none text-black text-sm">

    <button class="bg-gray-800 text-white px-4 text-sm hover:bg-gray-900">
        Cari
    </button>

</form>

</div>



<!-- REKOMENDASI -->
<div class="mb-6">
    <h3 class="text-xl font-bold text-black">
        Rekomendasi
    </h3>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@foreach($rekomendasi as $k)
<div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden transition">

    <!-- Gambar -->
@php
    $fotos = $k->fotos;

    if (is_string($fotos)) {
        $fotos = json_decode($fotos, true);
    }

    $fotos = $fotos ?? [];
@endphp

@if(count($fotos) > 0)
    <img src="{{ asset('storage/'.$fotos[0]['path']) }}"
         class="w-full h-40 object-contain hover:scale-105 transition duration-300">
@else
    <img src="https://via.placeholder.com/400x300"
         class="w-full h-40 object-contain">
@endif


    <div class="p-4">
        <h4 class="font-semibold text-gray-800">
            {{ $k->nama }}
        </h4>

        <p class="text-sm text-gray-500">
            {{ $k->alamat }}
        </p>

        <p class="text-amber-700 font-bold mt-2">
            Rp {{ number_format($k->harga) }} / bulan
        </p>

        <a href="{{ route('kontrakan.show', $k->id) }}"
   class="block bg-amber-700 text-white text-center mt-3 py-2 rounded hover:bg-amber-800 transition">
    Lihat Detail
</a>
    </div>

</div>
@endforeach

</div>


@endsection