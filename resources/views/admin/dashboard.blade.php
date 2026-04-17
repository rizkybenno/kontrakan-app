@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-6">Dashboard Admin</h2>

<div class="grid grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-500">Total Kontrakan</h3>
        <p class="text-2xl font-bold">10</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-500">Booking</h3>
        <p class="text-2xl font-bold">5</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-gray-500">Pembayaran</h3>
        <p class="text-2xl font-bold">3</p>
    </div>

</div>

@endsection