<!DOCTYPE html>
<html>
<head>
    <title>Sewa Kontrakan</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100" style="font-family: 'Poppins', sans-serif;">

<!-- Navbar -->
<nav class="bg-amber-700 text-white shadow px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">Kontrakan RDP</h1>

    <div>
        <a href="/" class="mr-4 hover:underline">Home</a>
        <a href="/kontrakan" class="mr-4 hover:underline">Kontrakanskontol</a>
        <a href="/login" class="mr-2 hover:underline">Login</a>
        <a href="/register" class="bg-white text-amber-700 px-4 py-2 rounded hover:bg-gray-100">
            Daftar
        </a>
    </div>
</nav>

<div class="p-6">
    @yield('content')
</div>

</body>
</html>