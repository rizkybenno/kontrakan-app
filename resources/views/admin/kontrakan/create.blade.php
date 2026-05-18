@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

    <!-- JUDUL -->
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Tambah Kontrakan
    </h2>

    <!-- ERROR VALIDASI -->
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
    <form action="{{ route('admin.kontrakan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">Nama Kontrakan</label>
            <input type="text" name="nama" value="{{ old('nama') }}"
                   class="w-full border rounded px-3 py-2 mt-1" required>
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">Alamat</label>
            <textarea name="alamat"
                      class="w-full border rounded px-3 py-2 mt-1" required>{{ old('alamat') }}</textarea>
        </div>

        <!-- Wilayah -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">Wilayah</label>
            <input type="text" name="wilayah" value="{{ old('wilayah') }}"
                   class="w-full border rounded px-3 py-2 mt-1" required>
        </div>

<!-- Jumlah Kamar -->
<div class="mb-4">
    <label class="text-sm text-gray-600">Jumlah Kamar</label>

    <input type="number"
           name="jumlah_kamar"
           value="{{ old('jumlah_kamar') }}"
           min="1"
           class="w-full border rounded px-3 py-2 mt-1"
           required>
</div>
    

        <!-- Deskripsi -->
<div class="mb-4">
    <label class="text-sm text-gray-600">Deskripsi</label>

    <textarea name="deskripsi"
              class="w-full border rounded px-3 py-2 mt-1"
              rows="4"
              placeholder="Deskripsi kontrakan...">{{ old('deskripsi') }}</textarea>
</div>

        <!-- Harga -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">Harga / bulan</label>
            <input type="number" name="harga" value="{{ old('harga') }}"
                   class="w-full border rounded px-3 py-2 mt-1" required>
        </div>

        <!-- Upload Foto -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">Upload Foto (bisa banyak)</label>

            <input type="file" name="fotos[]" id="fotoInput"
                   class="w-full border rounded px-3 py-2 mt-1" multiple>

            <!-- Preview -->
            <div id="previewContainer" class="flex gap-2 mt-3 flex-wrap"></div>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-between items-center mt-6">

            <a href="/admin/kontrakan"
               class="text-gray-500 hover:underline">
                ← Kembali
            </a>

            <button type="submit"
                class="bg-amber-700 text-white px-5 py-2 rounded hover:bg-amber-800 transition">
                Simpan
            </button>

        </div>

    </form>

</div>

<!-- 🔥 SCRIPT PREVIEW MULTI FOTO -->
<script>
document.getElementById('fotoInput').addEventListener('change', function(e) {
    const container = document.getElementById('previewContainer');
    container.innerHTML = '';

    Array.from(e.target.files).forEach(file => {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.classList.add('w-20', 'h-16', 'object-cover', 'rounded', 'border');
        container.appendChild(img);
    });
});
</script>

@endsection