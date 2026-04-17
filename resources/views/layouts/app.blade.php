<!DOCTYPE html>
<html>
<head>
    <title>Sewa Kontrakan</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body 
class="text-gray-800"
style="
    font-family: 'Poppins', sans-serif;
    background-image: url('https://wallpapers.com/images/hd/aesthetic-brown-background-71ajj9m8x6f2agz3.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
">

<!-- Navbar -->
<nav class="bg-amber-700 px-8 py-6 flex justify-between items-center">
    <div class="flex items-center space-x-2">
        <img src="{{ asset('images/logo.jpg') }}" class="w-12 h-12">
        <h1 class="text-2xl font-bold text-white tracking-wide">
            Kontrakan RDP
        </h1>
    </div>

    <div class="flex items-center space-x-6 text-sm">
        <a href="/" class="text-white hover:text-gray-200 transition">Home</a>
        <a href="/kontrakan" class="text-white hover:text-gray-200 transition">Kontrakan</a>
        <a href="/login" class="text-white hover:text-gray-200 transition">Login</a>

        <a href="/register"
           class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition shadow-sm font-bold">
            Daftar
        </a>
    </div>
</nav>

<!-- Content -->
<div class="p-6 max-w-6xl mx-auto">
    @yield('content')
</div>

<!-- Footer -->
<footer class="bg-amber-700 text-white mt-10">
    <div class="max-w-6xl mx-auto px-6 py-6 text-center">
        <h3 class="text-lg font-semibold mb-3">Kontrakan RDP</h3>

        <div class="space-y-2 text-sm">
            <div class="flex justify-center items-center space-x-3">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/1280px-WhatsApp.svg.png"
                     class="w-6 h-6">
                <span class="text-sm">085792223092</span>
            </div>

            <div class="flex justify-center items-center space-x-2">
                <img src="https://storage.googleapis.com/gweb-uniblog-publish-prod/images/Gmail.width-500.format-webp.webp"
                     class="w-6 h-6">
                <span>rizkyanandasmancis@gmail.com</span>
            </div>
        </div>

        <p class="text-xs text-gray-200 mt-4">
            © 2026 Kontrakan RDP
        </p>
    </div>
</footer>

</body>
</html>