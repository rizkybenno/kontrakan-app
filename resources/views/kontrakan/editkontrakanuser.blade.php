@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold text-amber-700 mb-6">
        Edit Kontrakan Saya
    </h2>

    <form action="{{ route('kontrakan.user.update') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- NAMA -->
        <div class="mb-4">
            <label class="block font-semibold">
                Nama Kontrakan
            </label>

            <input type="text"
                   name="nama"
                   value="{{ $kontrakan->nama }}"
                   class="w-full border p-3 rounded mt-1"
                   required>
        </div>

        <!-- ALAMAT -->
        <div class="mb-4">
            <label class="block font-semibold">
                Alamat
            </label>

            <textarea name="alamat"
                      class="w-full border p-3 rounded mt-1"
                      required>{{ $kontrakan->alamat }}</textarea>
        </div>

        <!-- WILAYAH -->
        <div class="mb-4">
            <label class="block font-semibold">
                Wilayah
            </label>

            <input type="text"
                   name="wilayah"
                   value="{{ $kontrakan->wilayah }}"
                   class="w-full border p-3 rounded mt-1"
                   required>
        </div>

        <!-- JUMLAH KAMAR -->
        <div class="mb-5">

            <label class="block font-semibold">
                Jumlah Kamar
            </label>

            <input type="number"
                   id="jumlahKamar"
                   name="jumlah_kamar"
                   min="1"
                   value="{{ $kontrakan->kamars->count() }}"
                   class="w-full border p-3 rounded mt-1"
                   required>

        </div>

        <!-- DETAIL KAMAR -->
        <div class="mb-6">

            <label class="block font-semibold mb-3">
                Detail Kamar
            </label>

            <div id="kamarContainer" class="space-y-4">

                @foreach($kontrakan->kamars as $index => $kamar)

                <div class="border rounded-xl p-4 bg-gray-50">

                    <input type="hidden"
                           name="kamars[{{ $index }}][id]"
                           value="{{ $kamar->id }}">

                    <h4 class="font-semibold text-gray-800 mb-4">
                        {{ $kamar->nama_kamar }}
                    </h4>

                    <!-- NAMA -->
                    <div class="mb-3">

                        <label class="text-sm text-gray-600">
                            Nama Kamar
                        </label>

                        <input type="text"
                               name="kamars[{{ $index }}][nama_kamar]"
                               value="{{ $kamar->nama_kamar }}"
                               class="w-full border rounded px-3 py-2 mt-1"
                               required>

                    </div>

                    <!-- HARGA -->
                    <div class="mb-3">

                        <label class="text-sm text-gray-600">
                            Harga / bulan
                        </label>

                        <input type="number"
                               name="kamars[{{ $index }}][harga]"
                               value="{{ $kamar->harga }}"
                               class="w-full border rounded px-3 py-2 mt-1">

                    </div>

                    <!-- STATUS -->
                    <div class="mb-3">

                        <label class="text-sm text-gray-600">
                            Status
                        </label>

                        <select name="kamars[{{ $index }}][status]"
                                class="w-full border rounded px-3 py-2 mt-1">

                            <option value="tersedia"
                                {{ $kamar->status == 'tersedia' ? 'selected' : '' }}>
                                Tersedia
                            </option>

                            <option value="dibooking"
                                {{ $kamar->status == 'dibooking' ? 'selected' : '' }}>
                                Dibooking
                            </option>

                            <option value="terisi"
                                {{ $kamar->status == 'terisi' ? 'selected' : '' }}>
                                Terisi
                            </option>

                        </select>

                    </div>

                    <!-- DESKRIPSI -->
                    <div>

                        <label class="text-sm text-gray-600">
                            Deskripsi
                        </label>

                        <textarea name="kamars[{{ $index }}][deskripsi]"
                                  rows="2"
                                  class="w-full border rounded px-3 py-2 mt-1">{{ $kamar->deskripsi }}</textarea>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

        <!-- HARGA -->
        <div class="mb-4">

            <label class="block font-semibold">
                Harga per bulan
            </label>

            <input type="number"
                   name="harga"
                   value="{{ $kontrakan->harga }}"
                   class="w-full border p-3 rounded mt-1"
                   required>

        </div>

        <!-- DESKRIPSI -->
        <div class="mb-4">

            <label class="block font-semibold">
                Deskripsi
            </label>

            <textarea name="deskripsi"
                      class="w-full border p-3 rounded mt-1">{{ $kontrakan->deskripsi }}</textarea>

        </div>

        <!-- FOTO -->
        <div class="mb-4">

            <label class="block font-semibold">
                Update Foto (opsional)
            </label>

            <input type="file"
                   name="fotos[]"
                   multiple
                   class="w-full border p-3 rounded mt-1">

        </div>

        <!-- STATUS -->
        <div class="mb-4 p-3 bg-yellow-100 text-yellow-700 rounded">

            ⚠️ Setelah diupdate, kontrakan akan kembali ke status
            <b>pending</b> untuk verifikasi admin.

        </div>

        <!-- BUTTON -->
        <div class="flex gap-3">

            <button type="submit"
                    class="bg-amber-700 text-white px-6 py-3 rounded hover:bg-amber-800">

                Simpan Perubahan

            </button>

            <a href="{{ route('kontrakan.saya') }}"
               class="bg-gray-500 text-white px-6 py-3 rounded hover:bg-gray-600">

                Batal

            </a>

        </div>

    </form>

</div>

<script>

const jumlahKamarInput = document.getElementById('jumlahKamar');
const kamarContainer = document.getElementById('kamarContainer');

jumlahKamarInput.addEventListener('input', function () {

    let jumlah = parseInt(this.value);

    if (jumlah < 1) return;

    let current = kamarContainer.children.length;

    /*
    |--------------------------------------------------------------------------
    | TAMBAH KAMAR
    |--------------------------------------------------------------------------
    */

    if (jumlah > current) {

        for (let i = current; i < jumlah; i++) {

            kamarContainer.innerHTML += `

            <div class="border rounded-xl p-4 bg-gray-50">

                <h4 class="font-semibold text-gray-800 mb-4">
                    Kamar ${i + 1}
                </h4>

                <!-- NAMA -->
                <div class="mb-3">

                    <label class="text-sm text-gray-600">
                        Nama Kamar
                    </label>

                    <input type="text"
                           name="kamars[${i}][nama_kamar]"
                           value="Kamar ${i + 1}"
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
                           class="w-full border rounded px-3 py-2 mt-1"
                           required>

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

    /*
    |--------------------------------------------------------------------------
    | HAPUS KAMAR
    |--------------------------------------------------------------------------
    */

    else if (jumlah < current) {

        while (kamarContainer.children.length > jumlah) {
            kamarContainer.removeChild(kamarContainer.lastElementChild);
        }
    }

});

</script>

@endsection