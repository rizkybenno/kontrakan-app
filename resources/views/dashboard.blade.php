@extends('layouts.app')

@section('content')

<!-- HERO -->
<div class="bg-amber-700 rounded-2xl p-10 text-white mb-8">

    <div class="text-center">
        <h2 class="text-3xl font-bold mb-3">
            Temukan Kontrakan Nyaman Impianmu 🏠
        </h2>

        <p class="text-sm md:text-base text-amber-100">
            Pilih hunian terbaik dengan harga terjangkau,
            fasilitas lengkap, dan lokasi strategis.
        </p>
    </div>

    <!-- SEARCH -->
    <form action="{{ route('kontrakan.index') }}"
          method="GET"
          class="mt-8 max-w-2xl mx-auto">

        <div class="flex bg-white rounded-xl overflow-hidden shadow-lg">

            <input type="text"
                   name="search"
                   placeholder="Cari kontrakan berdasarkan nama atau wilayah..."
                   class="w-full p-4 outline-none text-gray-700 text-sm">

            <button class="bg-gray-800 text-white px-6 hover:bg-gray-900 transition">
                Cari
            </button>

        </div>

    </form>

</div>

{{-- ================= AJUKAN / KONTRAKAN SAYA ================= --}}
<div class="bg-white rounded-xl shadow p-5 mb-8 border border-gray-100">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

        <div>
            <h3 class="text-xl font-bold text-gray-800">
                Punya Kontrakan?
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Promosikan kontrakan Anda dan temukan penyewa lebih mudah.
            </p>
        </div>

        @auth

            @if($punyaKontrakan)

                {{-- USER SUDAH PUNYA KONTRAKAN --}}
                <a href="{{ route('kontrakan.saya') }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg transition">
                    🏠 Lihat & Edit Kontrakan Saya
                </a>

            @else

                {{-- USER BELUM PUNYA KONTRAKAN --}}
                <a href="{{ route('kontrakan.pengajuan') }}"
                   class="bg-amber-700 hover:bg-amber-800 text-white px-5 py-3 rounded-lg transition">
                    + Ajukan Kontrakan
                </a>

            @endif

        @else

            {{-- BELUM LOGIN --}}
            <a href="{{ route('login') }}"
               class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-3 rounded-lg transition">
                Login untuk Mengajukan
            </a>

        @endauth

    </div>

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