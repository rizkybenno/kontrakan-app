@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow text-center">

    <!-- Icon / Status -->
    <div class="text-green-600 text-5xl mb-4">
        ✓
    </div>

    <!-- Judul -->
    <h2 class="text-2xl font-bold text-gray-800 mb-2">
        Pembayaran Berhasil Dikirim
    </h2>

    <!-- Deskripsi -->
    <p class="text-gray-600 mb-6">
        Silakan tunggu verifikasi dari admin. 
        Kami akan memproses pembayaran Anda secepat mungkin.
    </p>

    <!-- Tombol -->
    <a href="/kontrakan"
       class="inline-block bg-amber-700 text-white px-6 py-2 rounded-lg hover:bg-amber-800 transition">
        Kembali ke Beranda
    </a>

</div>

@endsection