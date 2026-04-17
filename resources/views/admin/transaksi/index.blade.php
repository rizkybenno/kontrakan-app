@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Data Transaksi</h2>

<table class="w-full bg-white rounded shadow">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">Nama</th>
            <th class="p-2">Kontrakan</th>
            <th class="p-2">Status</th>
        </tr>
    </thead>

    <tbody>
        <tr class="text-center border-t">
            <td class="p-2">Rizky</td>
            <td class="p-2">Kontrakan A</td>
            <td class="p-2 text-yellow-500">Pending</td>
        </tr>
    </tbody>
</table>

@endsection