@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold text-amber-700 mb-6">
        Frequently Asked Questions (FAQ)
    </h1>

    <div class="space-y-4">

        <!-- ITEM -->
        <details class="border rounded p-3">
            <summary class="font-semibold cursor-pointer">
                Bagaimana cara mencari kontrakan?
            </summary>
            <p class="mt-2 text-sm text-gray-600">
                Gunakan fitur pencarian di halaman kontrakan.
            </p>
        </details>

        <details class="border rounded p-3">
            <summary class="font-semibold cursor-pointer">
                Apakah harus membuat akun?
            </summary>
            <p class="mt-2 text-sm text-gray-600">
                Ya, untuk melakukan pemesanan wajib memiliki akun.
            </p>
        </details>

        <details class="border rounded p-3">
            <summary class="font-semibold cursor-pointer">
                Bagaimana cara pembayaran?
            </summary>
            <p class="mt-2 text-sm text-gray-600">
                Pembayaran dilakukan manual melalui transfer, tunai, atau QRIS.
            </p>
        </details>

        <details class="border rounded p-3">
            <summary class="font-semibold cursor-pointer">
                Apakah pembayaran otomatis?
            </summary>
            <p class="mt-2 text-sm text-gray-600">
                Tidak, pembayaran diverifikasi manual oleh admin.
            </p>
        </details>

        <details class="border rounded p-3">
            <summary class="font-semibold cursor-pointer">
                Apakah data saya aman?
            </summary>
            <p class="mt-2 text-sm text-gray-600">
                Ya, data hanya digunakan untuk kebutuhan sistem.
            </p>
        </details>

        <details class="border rounded p-3">
            <summary class="font-semibold cursor-pointer">
                Bisa batal pemesanan?
            </summary>
            <p class="mt-2 text-sm text-gray-600">
                Bisa selama belum dilakukan pembayaran.
            </p>
        </details>

    </div>

</div>

@endsection