<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Kontrakan RDP')</title>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="min-h-screen flex flex-col font-[Outfit] relative">

<!-- BACKGROUND -->
<div class="fixed inset-0 -z-10">
    <img src="https://wallpapercave.com/wp/wp12225686.jpg"
         class="w-full h-full object-cover">
</div>

<div class="fixed inset-0 bg-black/10 -z-10"></div>

<!-- NAVBAR -->
<nav class="bg-white shadow px-6 py-4 flex justify-between items-center">

    <a href="{{ route('home') }}" class="flex items-center gap-2">
        <img src="{{ asset('images/logo.jpg') }}" class="w-10 h-10">
        <span class="text-xl font-bold text-amber-700">Kontrakan RDP</span>
    </a>

    <div class="flex items-center gap-4 text-sm">

        @auth
    @if(auth()->user()->is_admin)
        <a href="{{ route('admin.panel') }}"
           class="px-4 py-2 rounded-lg bg-amber-600 text-white hover:bg-amber-700 transition">
            Admin
        </a>
    @endif
@endauth


        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('kontrakan.index') }}">Kontrakan</a>

        @auth
            <span>Halo, {{ auth()->user()->name }}</span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="text-red-500">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}" class="bg-amber-700 text-white px-3 py-1 rounded">
                Daftar
            </a>
        @endauth

    </div>
</nav>

<!-- CONTENT -->
<main class="flex-1 p-6">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="bg-amber-700 text-white mt-10">
    <div class="max-w-6xl mx-auto px-6 py-8">

        <div class="grid md:grid-cols-3 gap-6">

            <div>
                <h2 class="font-bold text-lg">Kontrakan RDP</h2>
                <p class="text-sm text-amber-100">Platform pencarian kontrakan terbaik.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">Menu</h3>
                <ul class="text-sm space-y-1">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('kontrakan.index') }}">Kontrakan</a></li>
                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                    <li><a href="{{ route('ketentuan') }}">Ketentuan</a></li>

          @auth
    @if(auth()->user()->is_admin)

        <li class="mt-3 font-semibold text-amber-300">
            Admin Panel
        </li>

        {{-- DASHBOARD ADMIN --}}
        <li>
            <a href="{{ route('admin.panel') }}"
               class="text-white/90 hover:underline block">
                Dashboard Admin
            </a>
        </li>

    @endif
@endauth

                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-2">Kontak</h3>
                <p class="text-sm">WhatsApp: 0812-3456-7890</p>
                <p class="text-sm">Email: kontrakanrdp@gmail.com</p>
            </div>

        </div>

        <div class="border-t border-amber-500 my-6"></div>

        <p class="text-center text-xs">
            © {{ date('Y') }} Kontrakan RDP
        </p>

    </div>
</footer>

</body>
</html>