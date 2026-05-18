@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white rounded-xl shadow p-6">

    <!-- Judul -->
    <h2 class="text-2xl font-bold text-center text-amber-700 mb-6">
        Daftar Akun
    </h2>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- Form Register -->
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- ================= NAMA ================= -->
        <div class="mb-4">
            <label for="name" class="block text-sm text-gray-600">
                Nama
            </label>

            <input 
                id="name"
                type="text" 
                name="name" 
                value="{{ old('name') }}"
                class="w-full border rounded px-3 py-2 mt-1 focus:ring-2 focus:ring-amber-500 outline-none"
                required
                autofocus
            >

            @error('name')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- ================= NO WHATSAPP ================= -->
<div class="mb-4">
    <label class="block text-sm text-gray-600">
        Nomor WhatsApp
    </label>

    <input 
        type="text"
        name="phone"
        value="{{ old('phone') }}"
        placeholder="08xxxxxxxxxx"
        class="w-full border rounded px-3 py-2 mt-1 focus:ring-2 focus:ring-amber-500 outline-none"
        required
    >

    @error('phone')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

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
                class="w-full border rounded px-3 py-2 mt-1 focus:ring-2 focus:ring-amber-500 outline-none"
                required
            >

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
                class="w-full border rounded px-3 py-2 mt-1 focus:ring-2 focus:ring-amber-500 outline-none"
                required
            >

            @error('password')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- ================= KONFIRMASI PASSWORD ================= -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm text-gray-600">
                Konfirmasi Password
            </label>

            <input 
                id="password_confirmation"
                type="password" 
                name="password_confirmation"
                class="w-full border rounded px-3 py-2 mt-1 focus:ring-2 focus:ring-amber-500 outline-none"
                required
            >
        </div>

<!-- ================= ALAMAT ================= -->
<div class="mb-4">
    <label class="block text-sm text-gray-600">
        Alamat
    </label>

    <textarea
        name="alamat"
        rows="3"
        class="w-full border rounded px-3 py-2 mt-1 focus:ring-2 focus:ring-amber-500 outline-none"
        placeholder="Masukkan alamat lengkap"
        required
    >{{ old('alamat') }}</textarea>

    @error('alamat')
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</div>
    

        <!-- ================= FOTO PROFIL ================= -->
        <div class="mb-4">
            <label for="fotoInput" class="block text-sm text-gray-600">
                Upload Foto
            </label>

            <input 
                id="fotoInput"
                type="file" 
                name="foto"
                accept="image/*"
                class="w-full border rounded px-3 py-2 mt-1"
                required
            >

            <!-- Preview -->
            <img 
                id="preview"
                class="mt-3 w-24 h-24 rounded-full object-cover hidden border"
            >

            @error('foto')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- CAPTCHA -->
<div class="mb-4">
    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>


        <!-- ================= BUTTON ================= -->
        <button type="submit"
    class="w-full bg-amber-700 text-white py-2 rounded hover:bg-amber-800 transition">
    Daftar
</button>

        <!-- ================= LINK LOGIN ================= -->
        <p class="text-sm text-center mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-amber-700 hover:underline font-medium">
                Login
            </a>
        </p>

    </form>

</div>

<!-- ================= SCRIPT PREVIEW FOTO ================= -->
<script>
document.getElementById('fotoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];

    if (file) {
        const preview = document.getElementById('preview');

        // Validasi sederhana (optional tapi bagus)
        if (!file.type.startsWith('image/')) {
            alert('File harus berupa gambar!');
            return;
        }

        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
    }
});
</script>

@endsection