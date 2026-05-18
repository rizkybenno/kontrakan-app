@extends('layouts.app')

@section('title', 'Ketentuan Penggunaan')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

    <!-- JUDUL -->
    <h1 class="text-2xl font-bold text-gray-800 mb-4">
        Ketentuan Penggunaan
    </h1>

    <p class="text-gray-600 mb-6">
        Dengan menggunakan sistem ini, pengguna dianggap telah membaca, memahami, dan menyetujui seluruh ketentuan yang berlaku.
    </p>

    <!-- ISI KETENTUAN -->
    <div class="space-y-6 text-gray-700 text-sm leading-relaxed">

        <!-- 1 -->
        <div>
            <h2 class="font-semibold text-gray-800">1. Ketentuan Umum</h2>
            <ul class="list-disc pl-5 mt-2 space-y-1">
                <li>Pengguna wajib menggunakan sistem sesuai dengan tujuan penyewaan kontrakan.</li>
                <li>Data yang dimasukkan harus benar, lengkap, dan dapat dipertanggungjawabkan.</li>
                <li>Dilarang menggunakan sistem untuk tujuan yang melanggar hukum atau merugikan pihak lain.</li>
            </ul>
        </div>

        <!-- 2 -->
        <div>
            <h2 class="font-semibold text-gray-800">2. Akun Pengguna</h2>
            <ul class="list-disc pl-5 mt-2 space-y-1">
                <li>Setiap pengguna wajib memiliki akun untuk dapat melakukan pemesanan.</li>
                <li>Pengguna bertanggung jawab penuh atas keamanan akun masing-masing.</li>
                <li>Dilarang membagikan akun kepada pihak lain tanpa izin.</li>
                <li>Admin berhak menonaktifkan akun yang melanggar ketentuan.</li>
            </ul>
        </div>

        <!-- 3 -->
        <div>
            <h2 class="font-semibold text-gray-800">3. Pemesanan Kontrakan</h2>
            <ul class="list-disc pl-5 mt-2 space-y-1">
                <li>Pemesanan dilakukan berdasarkan ketersediaan unit kontrakan.</li>
                <li>Data pemesanan harus diisi dengan benar sebelum dikonfirmasi.</li>
                <li>Pemesanan yang tidak dikonfirmasi dalam waktu tertentu dapat dibatalkan secara otomatis.</li>
            </ul>
        </div>

        <!-- 4 -->
        <div>
            <h2 class="font-semibold text-gray-800">4. Pembayaran</h2>
            <ul class="list-disc pl-5 mt-2 space-y-1">
                <li>Pembayaran dilakukan secara manual melalui transfer bank, tunai, atau QRIS.</li>
                <li>Bukti pembayaran wajib dikonfirmasi melalui sistem.</li>
                <li>Sistem tidak bertanggung jawab atas kesalahan transfer ke rekening yang tidak sesuai.</li>
            </ul>
        </div>

        <!-- 5 -->
        <div>
            <h2 class="font-semibold text-gray-800">5. Pembatalan</h2>
            <ul class="list-disc pl-5 mt-2 space-y-1">
                <li>Pembatalan pemesanan dapat dilakukan sebelum pembayaran dikonfirmasi.</li>
                <li>Jika pembayaran sudah dilakukan, pembatalan mengikuti kebijakan pengelola kontrakan.</li>
            </ul>
        </div>

        <!-- 6 -->
        <div>
            <h2 class="font-semibold text-gray-800">6. Hak dan Kewajiban Pengguna</h2>
            <ul class="list-disc pl-5 mt-2 space-y-1">
                <li>Pengguna berhak mendapatkan informasi kontrakan yang akurat dan terbaru.</li>
                <li>Pengguna wajib menjaga etika dalam menggunakan sistem.</li>
                <li>Pengguna dilarang menyalahgunakan fitur sistem.</li>
            </ul>
        </div>

        <!-- 7 -->
        <div>
            <h2 class="font-semibold text-gray-800">7. Penutupan</h2>
            <p class="mt-2">
                Pengelola berhak mengubah ketentuan ini sewaktu-waktu tanpa pemberitahuan terlebih dahulu.
                Dengan tetap menggunakan sistem, pengguna dianggap menyetujui perubahan tersebut.
            </p>
        </div>

    </div>

</div>

@endsection