@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                Kelola Booking
            </h2>

            <p class="text-gray-500 mt-1">
                Verifikasi pembayaran dan kelola booking kontrakan
            </p>
        </div>

    </div>

    <!-- SUCCESS -->
    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-5">
            {{ session('success') }}
        </div>

    @endif

    <!-- TABLE -->
    <div class="bg-white shadow rounded-2xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-100 text-gray-700">

                    <tr>

                        <th class="px-6 py-4">
                            ID
                        </th>

                        <th class="px-6 py-4">
                            User
                        </th>

                        <th class="px-6 py-4">
                            Kontrakan
                        </th>

                        <th class="px-6 py-4">
                            Lama Sewa
                        </th>

                        <th class="px-6 py-4">
                            Metode
                        </th>

                        <th class="px-6 py-4">
                            Total
                        </th>

                        <th class="px-6 py-4">
                            Bukti
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($bookings as $booking)

                        <tr class="border-b hover:bg-gray-50">

                            <!-- ID -->
                            <td class="px-6 py-4 font-semibold text-gray-700">
                                #{{ $booking->id }}
                            </td>

                            <!-- USER -->
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800">
                                    {{ $booking->user->name }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $booking->no_hp }}
                                </div>
                            </td>

                            <!-- KONTRAKAN -->
                            <td class="px-6 py-4">
                                {{ $booking->kontrakan->nama }}
                            </td>

                            <!-- LAMA SEWA -->
                            <td class="px-6 py-4">
                                {{ $booking->lama_sewa }} Bulan
                            </td>

                            <!-- METODE -->
                            <td class="px-6 py-4 uppercase">
                                {{ $booking->metode_pembayaran }}
                            </td>

                            <!-- TOTAL -->
                            <td class="px-6 py-4 font-semibold text-amber-700">
                                Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                            </td>

                            <!-- BUKTI -->
                            <td class="px-6 py-4">

                                @if($booking->bukti_pembayaran)

                                    <a href="{{ asset('storage/' . $booking->bukti_pembayaran) }}"
                                       target="_blank">

                                        <img src="{{ asset('storage/' . $booking->bukti_pembayaran) }}"
                                             class="w-20 h-20 object-cover rounded-lg border hover:scale-105 transition">

                                    </a>

                                @else

                                    <span class="text-gray-400 text-xs">
                                        Belum Upload
                                    </span>

                                @endif

                            </td>

                            <!-- STATUS -->
                            <td class="px-6 py-4">

                                @if($booking->status == 'pending')

                                    <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full">
                                        Pending
                                    </span>

                                @elseif($booking->status == 'menunggu_verifikasi')

                                    <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">
                                        Menunggu Verifikasi
                                    </span>

                                @elseif($booking->status == 'approved')

                                    <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                        Disetujui
                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full">
                                        Ditolak
                                    </span>

                                @endif

                            </td>

                            <!-- AKSI -->
                            <td class="px-6 py-4">

                                <div class="flex gap-2 justify-center">

                                    <!-- APPROVE -->
                                    <form method="POST"
                                          action="{{ route('admin.booking.approve', $booking->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-xs">

                                            Approve

                                        </button>

                                    </form>

                                    <!-- REJECT -->
                                    <form method="POST"
                                          action="{{ route('admin.booking.reject', $booking->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-xs">

                                            Reject

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9"
                                class="text-center py-10 text-gray-500">

                                Belum ada data booking

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection