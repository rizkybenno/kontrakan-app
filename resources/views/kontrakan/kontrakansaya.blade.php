@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto bg-white rounded-xl shadow p-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Kontrakan Saya
        </h2>

        <span class="text-sm px-3 py-1 rounded-full
            @if($kontrakan)
                bg-amber-100 text-amber-700
            @else
                bg-gray-100 text-gray-500
            @endif
        ">
            {{ $kontrakan ? ucfirst($kontrakan->status_pengajuan) : 'Belum Punya' }}
        </span>
    </div>

    @if($kontrakan)

        {{-- CARD KONTRAKAN --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- INFO --}}
            <div>

                <h3 class="text-xl font-bold text-gray-800">
                    {{ $kontrakan->nama }}
                </h3>

                <p class="text-gray-500 text-sm mt-1">
                    📍 {{ $kontrakan->alamat }}
                </p>

                <p class="text-amber-700 text-xl font-bold mt-4">
                    Rp {{ number_format($kontrakan->harga) }} / bulan
                </p>

                <div class="mt-4 text-sm text-gray-600">
                    <p><b>Wilayah:</b> {{ $kontrakan->wilayah }}</p>
                    <p><b>Kamar:</b> {{ $kontrakan->jumlah_kamar ?? '-' }}</p>
                </div>

                <div class="mt-6 text-sm text-gray-600">
                    {{ $kontrakan->deskripsi }}
                </div>

                {{-- BUTTON --}}
                <div class="mt-6 flex gap-3">

                    <a href="{{ route('kontrakan.user.edit') }}"
                       class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                        ✏️ Edit Kontrakan
                    </a>

                    <a href="/kontrakan"
                       class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600">
                        Kembali
                    </a>

                </div>

            </div>

            {{-- IMAGE --}}
            <div>

                @php
                    $fotos = is_array($kontrakan->fotos)
                        ? $kontrakan->fotos
                        : json_decode($kontrakan->fotos, true) ?? [];
                @endphp

                @if(!empty($fotos))
                    <img src="{{ asset('storage/'.$fotos[0]['path']) }}"
                         class="w-full h-[350px] object-contain bg-gray-100 rounded-lg">
                @else
                    <div class="w-full h-[350px] bg-gray-200 flex items-center justify-center rounded-lg">
                        <span class="text-gray-400">Tidak ada foto</span>
                    </div>
                @endif

            </div>

        </div>

    @else

        {{-- EMPTY STATE --}}
        <div class="text-center py-10">

            <p class="text-gray-500 mb-4">
                Kamu belum memiliki kontrakan
            </p>

            <a href="{{ route('kontrakan.pengajuan') }}"
               class="bg-amber-700 text-white px-6 py-3 rounded-lg hover:bg-amber-800">
                + Ajukan Kontrakan
            </a>

        </div>

    @endif

</div>

@endsection