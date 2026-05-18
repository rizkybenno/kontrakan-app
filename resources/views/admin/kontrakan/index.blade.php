@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Kelola Kontrakan
        </h2>

        <a href="{{ route('admin.kontrakan.create') }}"
           class="bg-amber-700 text-white px-4 py-2 rounded hover:bg-amber-800 transition">
            + Tambah Kontrakan
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- LIST DATA --}}
    <div class="space-y-4">

        @forelse($kontrakan as $k)

            @php
                $fotos = is_array($k->fotos)
                    ? $k->fotos
                    : json_decode($k->fotos, true) ?? [];

                $cover = collect($fotos)->firstWhere('is_cover', true);

                $coverPath = $cover['path'] ?? ($fotos[0]['path'] ?? null);
            @endphp

            <div class="bg-white p-4 rounded-xl shadow flex items-center justify-between gap-4">

                {{-- LEFT --}}
                <div class="flex items-center gap-4">

                    {{-- FOTO --}}
                    <div class="w-20 h-20 flex-shrink-0">

                        @if($coverPath)
                            <img src="{{ asset('storage/'.$coverPath) }}"
                                 class="w-full h-full object-cover rounded-lg border">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-lg">
                                <span class="text-xs text-gray-400">No Image</span>
                            </div>
                        @endif

                    </div>

                    {{-- INFO --}}
                    <div>

                        <h3 class="font-semibold text-gray-800">
                            {{ $k->nama }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            {{ $k->wilayah }}
                        </p>

                        <p class="text-amber-700 font-bold">
                            Rp {{ number_format($k->harga, 0, ',', '.') }}
                        </p>

                        {{-- STATUS --}}
                        <span class="text-xs px-2 py-1 rounded mt-1 inline-block
                            @if($k->status_pengajuan == 'approved')
                                bg-green-100 text-green-700
                            @elseif($k->status_pengajuan == 'rejected')
                                bg-red-100 text-red-700
                            @else
                                bg-yellow-100 text-yellow-700
                            @endif
                        ">
                            {{ strtoupper($k->status_pengajuan) }}
                        </span>

                    </div>

                </div>

                {{-- ACTION --}}
                <div class="flex gap-2 items-center">

                    {{-- EDIT --}}
                    <a href="{{ route('admin.kontrakan.edit', $k->id) }}"
                       class="bg-blue-500 text-white px-3 py-1 rounded">
                        Edit
                    </a>

                    {{-- DELETE --}}
                    <form action="{{ route('admin.kontrakan.destroy', $k->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin mau hapus?')">
                        @csrf
                        @method('DELETE')

                        <button class="bg-red-500 text-white px-3 py-1 rounded">
                            Hapus
                        </button>
                    </form>

                    {{-- APPROVAL --}}
                    @if($k->status_pengajuan == 'pending')

                        <form action="{{ route('admin.kontrakan.approve', $k->id) }}"
                              method="POST">
                            @csrf
                            <button class="bg-green-500 text-white px-3 py-1 rounded">
                                Approve
                            </button>
                        </form>

                        <form action="{{ route('admin.kontrakan.reject', $k->id) }}"
                              method="POST">
                            @csrf
                            <button class="bg-gray-500 text-white px-3 py-1 rounded">
                                Reject
                            </button>
                        </form>

                    @endif

                </div>

            </div>

        @empty
            <p class="text-center text-gray-500 py-6">
                Belum ada data kontrakan 😢
            </p>
        @endforelse

    </div>

    {{-- BACK BUTTON --}}
    <div class="mt-8 flex justify-center">
        <a href="{{ route('admin.panel') }}"
           class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-300 transition shadow-sm">
            ← Kembali ke Admin Panel
        </a>
    </div>

</div>

@endsection