@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

    <!-- JUDUL -->
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Edit Kontrakan
    </h2>

    <!-- ERROR -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="text-sm list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM -->
    <form action="{{ route('admin.kontrakan.update', $kontrakan->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- Nama -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">
                Nama Kontrakan
            </label>

            <input type="text"
                   name="nama"
                   value="{{ old('nama', $kontrakan->nama) }}"
                   class="w-full border rounded px-3 py-2 mt-1"
                   required>
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">
                Alamat
            </label>

            <textarea name="alamat"
                      class="w-full border rounded px-3 py-2 mt-1"
                      required>{{ old('alamat', $kontrakan->alamat) }}</textarea>
        </div>

        <!-- Wilayah -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">
                Wilayah
            </label>

            <input type="text"
                   name="wilayah"
                   value="{{ old('wilayah', $kontrakan->wilayah) }}"
                   class="w-full border rounded px-3 py-2 mt-1"
                   required>
        </div>

        <!-- Jumlah Kamar -->
<div class="mb-4">
    <label class="text-sm text-gray-600">
        Jumlah Kamar
    </label>

    <input type="number"
           name="jumlah_kamar"
           value="{{ old('jumlah_kamar', $kontrakan->jumlah_kamar) }}"
           min="1"
           class="w-full border rounded px-3 py-2 mt-1"
           required>
</div>

        <!-- Harga -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">
                Harga / bulan
            </label>

            <input type="number"
                   name="harga"
                   value="{{ old('harga', $kontrakan->harga) }}"
                   class="w-full border rounded px-3 py-2 mt-1"
                   required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">
                Deskripsi
            </label>

            <textarea name="deskripsi"
                      rows="4"
                      class="w-full border rounded px-3 py-2 mt-1">{{ old('deskripsi', $kontrakan->deskripsi) }}</textarea>
        </div>

        <!-- FOTO LAMA -->
        <div class="mb-4">

            <label class="text-sm text-gray-600">
                Foto Lama
            </label>

            @php
                $fotos = is_array($kontrakan->fotos)
                    ? $kontrakan->fotos
                    : json_decode($kontrakan->fotos, true) ?? [];
            @endphp

            <div class="flex gap-3 mt-3 flex-wrap">

                @forelse($fotos as $index => $foto)

                    <div class="relative">

                        <img src="{{ asset('storage/' . $foto['path']) }}"
                             class="w-24 h-20 object-cover rounded border">

                        @if(!empty($foto['is_cover']))
                            <span class="absolute top-1 left-1 bg-amber-700 text-white text-xs px-2 py-1 rounded">
                                Cover
                            </span>
                        @endif

                        <!-- HAPUS -->
                        <form action="{{ route('admin.kontrakan.foto.delete', [$kontrakan->id, $index]) }}"
                              method="POST"
                              class="absolute top-0 right-0">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Hapus foto ini?')"
                                    class="bg-red-500 text-white text-xs px-2 py-1 rounded">
                                ✕
                            </button>

                        </form>

                    </div>

                @empty

                    <p class="text-gray-400 text-sm">
                        Belum ada foto
                    </p>

                @endforelse

            </div>

        </div>

        <!-- TAMBAH FOTO -->
        <div class="mb-4">

            <label class="text-sm text-gray-600">
                Tambah Foto
            </label>

            <input type="file"
                   name="fotos[]"
                   id="fotoInput"
                   multiple
                   class="w-full border rounded px-3 py-2 mt-1">

            <!-- PREVIEW -->
            <div id="previewContainer"
                 class="flex gap-2 mt-3 flex-wrap"></div>

        </div>

        <!-- BUTTON -->
        <div class="flex justify-between items-center mt-6">

            <a href="{{ route('admin.kontrakan.index') }}"
               class="text-gray-500 hover:underline">
                ← Kembali
            </a>

            <button type="submit"
                    class="bg-amber-700 text-white px-5 py-2 rounded hover:bg-amber-800 transition">
                Update
            </button>

        </div>

    </form>

</div>

<!-- PREVIEW FOTO -->
<script>
document.getElementById('fotoInput').addEventListener('change', function(e) {

    const container = document.getElementById('previewContainer');

    container.innerHTML = '';

    Array.from(e.target.files).forEach(file => {

        const img = document.createElement('img');

        img.src = URL.createObjectURL(file);

        img.classList.add(
            'w-20',
            'h-16',
            'object-cover',
            'rounded',
            'border'
        );

        container.appendChild(img);
    });
});
</script>

@endsection