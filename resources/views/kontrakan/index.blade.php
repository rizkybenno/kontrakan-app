@extends('layouts.app')

@section('content')


<!-- Judul -->
<div class="bg-amber-700 p-4 rounded-xl mb-6 shadow">
    <h2 class="text-2xl font-bold text-white">
        Daftar Kontrakan
    </h2>

    
</div>

 <h4 class="text-xl font-bold text-gray-800 mb-4">
    Temukan kontrakan yang sesuai untuk Anda pesan
</h4>


@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
        {{ session('success') }}
    </div>
@endif

<!-- SEARCH -->
@php
$isAdmin = auth()->check() && auth()->user()->is_admin;
@endphp

<div class="mb-6 flex justify-between items-center">

    <!-- SEARCH -->
    <form action="/kontrakan" method="GET" class="flex w-full max-w-md">

        <input type="text" name="search"
               value="{{ request('search') }}"
               placeholder="Cari kontrakan..."
               class="w-full p-3 rounded-l-lg border border-gray-300 outline-none text-sm">

        <button class="bg-amber-700 text-white px-4 rounded-r-lg hover:bg-amber-800 text-sm">
            Cari
        </button>

    </form>

    

    <!-- BUTTON ADMIN -->
    @if($isAdmin)
    <a href="{{ route('admin.kontrakan.create') }}"
       class="ml-4 bg-amber-700 text-white px-4 py-3 rounded-lg text-sm hover:bg-amber-800 whitespace-nowrap">
        + Tambah Kontrakan
    </a>
    @endif

</div>

<!-- INFO HASIL SEARCH -->
@if(request('search'))
    <p class="text-sm text-gray-600 mb-4">
        Hasil pencarian untuk:
        <span class="font-semibold">"{{ request('search') }}"</span>
    </p>
@endif

<!-- Grid -->
<div class="grid grid-cols-3 gap-6">
@php
$isAdmin = auth()->check() && auth()->user()->is_admin;
@endphp

@forelse($kontrakan as $k)

@php
    $kelurahan = '';
    $kecamatan = '';

    if (!empty($k->wilayah)) {
        $kelurahan = $k->wilayah;
    }
@endphp


<div class="bg-white rounded-xl shadow hover:shadow-lg overflow-hidden transition relative">

    @if($isAdmin)
<div class="absolute top-2 right-2 flex gap-1">

    <a href="{{ route('admin.kontrakan.edit', $k->id) }}"
       class="bg-blue-500 text-white px-3 py-1 rounded">
        Edit
    </a>

    <form id="delete-form-{{ $k->id }}" action="/admin/kontrakan/{{ $k->id }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="button"
        onclick="confirmDelete({{ $k->id }}, '{{ $k->nama }}')"
        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
        Hapus
    </button>
</form>

</div>
@endif

    <!-- Gambar -->
   @php
    $fotos = is_array($k->fotos)
        ? $k->fotos
        : json_decode($k->fotos, true) ?? [];
@endphp

@if(!empty($fotos))
    <img src="{{ asset('storage/'.$fotos[0]['path']) }}"
         class="w-full h-40 object-contain">
@else
    <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
        <span class="text-gray-400 text-sm">Tidak ada foto</span>
    </div>
@endif

    <div class="p-4">

        <!-- Nama -->
        <h3 class="font-semibold text-gray-800">
            {{ $k->nama }}
        </h3>

        <!-- Lokasi -->
        <p class="text-gray-400 text-xs mt-1">
    {{ $k->wilayah }}
</p>

        <!-- Harga -->
        <p class="text-amber-700 font-bold mt-2">
            Rp {{ number_format($k->harga) }} / bulan
        </p>

        <a href="{{ route('kontrakan.show', $k->id) }}"
   class="block bg-amber-700 text-white text-center mt-3 py-2 rounded hover:bg-amber-800 transition">
    Lihat Detail
</a>

    </div>

</div>

@empty
    <p class="text-gray-500">
        Kontrakan tidak ditemukan 😢
    </p>
@endforelse

</div>

<script>
function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Apakah anda Yakin?',
        text: "Kontrakan \"" + nama + "\" akan dihapus?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    })
}
</script>

@endsection