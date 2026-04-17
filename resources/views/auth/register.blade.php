@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white rounded-xl shadow p-6">

    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
        Daftar Akun
    </h2>

    <form>

        <!-- Nama -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-600">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Email</label>
            <input type="email"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-600">
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Password</label>
            <input type="password"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-600">
        </div>

        <!-- Konfirmasi -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Konfirmasi Password</label>
            <input type="password"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-600">
        </div>

        <!-- Tombol -->
        <button type="submit"
            class="w-full bg-amber-700 text-white py-2 rounded-lg hover:bg-amber-800 transition font-semibold">
            Daftar
        </button>

    </form>

    <!-- Link -->
    <p class="text-center text-sm text-gray-500 mt-4">
        Sudah punya akun?
        <a href="/login" class="text-amber-700 font-semibold hover:underline">
            Login
        </a>
    </p>

</div>

@endsection