@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white rounded-xl shadow p-6">

    <!-- Judul Halaman -->
    <h2 class="text-2xl font-bold text-center text-amber-700 mb-6">
        Login
    </h2>

    <!-- Form Login -->
    <form method="POST" action="{{ route('login') }}">
        @csrf <!-- WAJIB: proteksi CSRF Laravel -->

        <!-- ================= EMAIL ================= -->
        <div class="mb-4">
            <label for="email" class="block text-sm text-gray-600">
                Email
            </label>

            <input 
                id="email"
                type="email" 
                name="email" 
                value="{{ old('email') }}"
                class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-amber-500"
                required
                autofocus
            >

            <!-- Error Email -->
            @error('email')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- ================= PASSWORD ================= -->
        <div class="mb-4">
            <label for="password" class="block text-sm text-gray-600">
                Password
            </label>

            <input 
                id="password"
                type="password" 
                name="password"
                class="w-full border rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-amber-500"
                required
            >

            <!-- Error Password -->
            @error('password')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- ================= REMEMBER ME ================= -->
        <div class="mb-4 text-sm flex items-center gap-2">
            <input 
                type="checkbox" 
                name="remember" 
                id="remember"
            >
            <label for="remember">
                Ingat saya
            </label>
        </div>

        <!-- ================= BUTTON ================= -->
        <button 
            type="submit"
            class="w-full bg-amber-700 text-white py-2 rounded hover:bg-amber-800 transition"
        >
            Login
        </button>

        <a href="{{ route('password.request') }}"
   class="text-sm text-amber-700 hover:underline">
    Lupa password?
</a>

        <!-- ================= LINK REGISTER ================= -->
        <p class="text-sm text-center mt-4">
            Belum punya akun?
            <a 
                href="{{ route('register') }}" 
                class="text-amber-700 hover:underline font-medium"
            >
                Daftar
            </a>
        </p>

    </form>

</div>

@endsection