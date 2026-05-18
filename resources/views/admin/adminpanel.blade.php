@extends('layouts.app')

@section('title', 'Admin Panel')

@section('content')

<div class="flex gap-6">

    {{-- SIDEBAR (FIX STICKY) --}}
    <aside class="w-64 bg-white rounded-2xl shadow p-5 h-fit sticky top-6">

        <h2 class="text-xl font-bold text-amber-700 mb-6">
            Admin Panel
        </h2>

        <nav class="space-y-2 text-sm">

            <a href="{{ route('admin.users.index') }}" class="block px-4 py-3 rounded-lg hover:bg-amber-100">
                👤 Kelola User
            </a>

            <a href="{{ route('admin.kontrakan.index') }}" class="block px-4 py-3 rounded-lg hover:bg-amber-100">
                🏠 Kelola Kontrakan
            </a>

            {{-- 🔥 TAMBAHAN BOOKING --}}
    <a href="{{ route('admin.booking.index') }}" class="block px-4 py-3 rounded-lg hover:bg-amber-100">
        📑 Kelola Booking
    </a>

            <a href="{{ route('admin.reports.index') }}" class="block px-4 py-3 rounded-lg hover:bg-amber-100">
                🚨 Review Report
            </a>

        </nav>

    </aside>

    {{-- CONTENT --}}
    <div class="flex-1 space-y-8">

        {{-- HEADER --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h1 class="text-3xl font-bold text-amber-700">Dashboard Admin</h1>
            <p class="text-gray-500 mt-2">Selamat datang di halaman admin.</p>
        </div>

        {{-- STATISTIK UTAMA --}}
<div class="grid md:grid-cols-5 gap-4">

    <!-- USER -->
    <div class="bg-white rounded-2xl shadow p-5">

        <p class="text-sm text-gray-500">
            User
        </p>

        <h2 class="text-3xl font-bold text-amber-700 mt-2">
            {{ $totalUsers ?? 0 }}
        </h2>

    </div>

    <!-- KONTRAKAN -->
    <div class="bg-white rounded-2xl shadow p-5">

        <p class="text-sm text-gray-500">
            Kontrakan
        </p>

        <h2 class="text-3xl font-bold text-amber-700 mt-2">
            {{ $totalKontrakan ?? 0 }}
        </h2>

    </div>

    <!-- TOTAL BOOKING -->
    <div class="bg-white rounded-2xl shadow p-5">

        <p class="text-sm text-gray-500">
            Total Booking
        </p>

        <h2 class="text-3xl font-bold text-blue-600 mt-2">
            {{ $totalBooking ?? 0 }}
        </h2>

    </div>

    <!-- PEMBAYARAN -->
    <div class="bg-white rounded-2xl shadow p-5">

        <p class="text-sm text-gray-500">
            Pembayaran
        </p>

        <h2 class="text-3xl font-bold text-green-600 mt-2">
            {{ $totalPembayaran ?? 0 }}
        </h2>

    </div>

    <!-- APPROVED -->
    <div class="bg-white rounded-2xl shadow p-5">

        <p class="text-sm text-gray-500">
            Approved
        </p>

        <h2 class="text-3xl font-bold text-purple-600 mt-2">
            {{ $bookingApproved ?? 0 }}
        </h2>

    </div>

</div>

{{-- STATUS BOOKING --}}
<div class="grid md:grid-cols-3 gap-4">

    <!-- PENDING -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-5">

        <p class="text-sm text-yellow-700">
            Booking Pending
        </p>

        <h2 class="text-3xl font-bold text-yellow-600 mt-2">
            {{ $bookingPending ?? 0 }}
        </h2>

    </div>

    <!-- APPROVED -->
    <div class="bg-green-50 border border-green-200 rounded-2xl p-5">

        <p class="text-sm text-green-700">
            Booking Approved
        </p>

        <h2 class="text-3xl font-bold text-green-600 mt-2">
            {{ $bookingApproved ?? 0 }}
        </h2>

    </div>

    <!-- REJECTED -->
    <div class="bg-red-50 border border-red-200 rounded-2xl p-5">

        <p class="text-sm text-red-700">
            Booking Rejected
        </p>

        <h2 class="text-3xl font-bold text-red-600 mt-2">
            {{ $bookingRejected ?? 0 }}
        </h2>

    </div>

</div>

    
        

    </div>

</div>

@endsection