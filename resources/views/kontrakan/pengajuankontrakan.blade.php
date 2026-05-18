@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

    <!-- JUDUL -->
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Ajukan / Promosikan Kontrakan
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
    <form action="{{ route('kontrakan.storePengajuan') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

        <!-- Nama -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">
                Nama Kontrakan
            </label>

            <input type="text"
                   name="nama"
                   value="{{ old('nama') }}"
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
                      required>{{ old('alamat') }}</textarea>
        </div>

        <!-- Wilayah -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">
                Wilayah
            </label>

            <input type="text"
                   name="wilayah"
                   value="{{ old('wilayah') }}"
                   class="w-full border rounded px-3 py-2 mt-1"
                   required>
        </div>

        <!-- JUMLAH KAMAR -->
<div class="mb-4">

    <label class="text-sm text-gray-600">
        Jumlah Kamar
    </label>

    <input type="number"
           id="jumlahKamar"
           min="1"
           value="1"
           class="w-full border rounded px-3 py-2 mt-1"
           required>

</div>

<!-- DETAIL KAMAR -->
<div class="mb-6">

    <label class="text-sm font-semibold text-gray-700 block mb-3">
        Detail Kamar
    </label>

    <div id="kamarContainer" class="space-y-4"></div>

</div>

<script>

function renderKamarForm(jumlah)
{
    const container = document.getElementById('kamarContainer');

    container.innerHTML = '';

    for(let i = 1; i <= jumlah; i++)
    {
        container.innerHTML += `
        
        <div class="border rounded-xl p-4 bg-gray-50">

            <h4 class="font-semibold text-gray-800 mb-4">
                Kamar ${i}
            </h4>

            <!-- NAMA -->
            <div class="mb-3">

                <label class="text-sm text-gray-600">
                    Nama Kamar
                </label>

                <input type="text"
                       name="kamars[${i}][nama_kamar]"
                       value="Kamar ${i}"
                       class="w-full border rounded px-3 py-2 mt-1"
                       required>

            </div>

            <!-- HARGA -->
            <div class="mb-3">

                <label class="text-sm text-gray-600">
                    Harga / bulan
                </label>

                <input type="number"
                       name="kamars[${i}][harga]"
                       class="w-full border rounded px-3 py-2 mt-1">

            </div>

            <!-- STATUS -->
            <div class="mb-3">

                <label class="text-sm text-gray-600">
                    Status
                </label>

                <select name="kamars[${i}][status]"
                        class="w-full border rounded px-3 py-2 mt-1">

                    <option value="tersedia">
                        Tersedia
                    </option>

                    <option value="dibooking">
                        Dibooking
                    </option>

                    <option value="terisi">
                        Terisi
                    </option>

                </select>

            </div>

            <!-- DESKRIPSI -->
            <div>

                <label class="text-sm text-gray-600">
                    Deskripsi
                </label>

                <textarea name="kamars[${i}][deskripsi]"
                          rows="2"
                          class="w-full border rounded px-3 py-2 mt-1"></textarea>

            </div>

        </div>
        `;
    }
}

document.getElementById('jumlahKamar')
.addEventListener('input', function() {

    renderKamarForm(this.value);

});

// default pertama
renderKamarForm(1);

</script>

        <!-- Harga -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">
                Harga / bulan
            </label>

            <input type="number"
                   name="harga"
                   value="{{ old('harga') }}"
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
                      class="w-full border rounded px-3 py-2 mt-1">{{ old('deskripsi') }}</textarea>
        </div>

        <!-- FOTO -->
        <div class="mb-4">

            <label class="text-sm text-gray-600">
                Upload Foto Kontrakan
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

        <!-- INFO -->
        <div class="bg-yellow-100 text-yellow-800 text-sm p-3 rounded mb-5">
            Pengajuan akan ditinjau terlebih dahulu oleh admin sebelum tampil di website.
        </div>

        <!-- BUTTON -->
        <div class="flex justify-between items-center mt-6">

            <a href="/kontrakan"
               class="text-gray-500 hover:underline">
                ← Kembali
            </a>

            <button type="submit"
                    class="bg-amber-700 text-white px-5 py-2 rounded hover:bg-amber-800 transition">
                Kirim Pengajuan
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