@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow p-6">

    <!-- HEADER -->
    <div class="mb-6">

        <h2 class="text-2xl font-bold text-gray-800">
            Pembayaran Booking
        </h2>

        <p class="text-gray-500 mt-1">

            Kontrakan:

            <span class="font-semibold text-amber-700">
                {{ $booking->kontrakan->nama }}
            </span>

        </p>

    </div>

    <!-- DETAIL BOOKING -->
    <div class="border rounded-2xl p-5 bg-gray-50 mb-6">

        <div class="grid md:grid-cols-2 gap-5">

            <!-- LAMA SEWA -->
            <div>

                <p class="text-sm text-gray-500">
                    Lama Sewa
                </p>

                <p class="font-semibold text-lg text-gray-800 mt-1">
                    {{ $booking->lama_sewa }} Bulan
                </p>

            </div>

            <!-- TOTAL -->
            <div>

                <p class="text-sm text-gray-500">
                    Total Pembayaran
                </p>

                <p class="font-bold text-3xl text-amber-700 mt-1">
                    Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                </p>

            </div>

        </div>

    </div>

    <!-- METODE PEMBAYARAN -->
    <div class="border rounded-2xl p-6">

        <h3 class="font-semibold text-gray-700 mb-5">
            Metode Pembayaran
        </h3>

        {{-- ================= BCA ================= --}}
        @if($booking->metode_pembayaran == 'bca')

            <div class="text-center">

                <img src="https://www.bca.co.id/-/media/Feature/Card/List-Card/Tentang-BCA/Brand-Assets/Logo-BCA/Logo-BCA_Biru.png"
                     class="w-24 mx-auto mb-4">

                <p class="text-gray-500 mb-2">
                    Transfer ke rekening berikut:
                </p>

                <h3 class="text-3xl font-bold text-gray-800 tracking-wide">
                    1234567890
                </h3>

                <p class="text-gray-500 mt-2">
                    a.n Rizky Ananda
                </p>

            </div>

        {{-- ================= BSI ================= --}}
        @elseif($booking->metode_pembayaran == 'bsi')

            <div class="text-center">

                <img src="https://iconlogovector.com/uploads/images/2023/11/lg-65571292f0011-bsi.png"
                     class="w-24 mx-auto mb-4">

                <p class="text-gray-500 mb-2">
                    Transfer ke rekening berikut:
                </p>

                <h3 class="text-3xl font-bold text-gray-800 tracking-wide">
                    9876543210
                </h3>

                <p class="text-gray-500 mt-2">
                    a.n Rizky Ananda
                </p>

            </div>

        {{-- ================= QRIS ================= --}}
        @elseif($booking->metode_pembayaran == 'qris')

            <div class="text-center">

                <p class="text-gray-500 mb-4">
                    Scan QRIS berikut untuk melakukan pembayaran
                </p>

                <img src="{{ asset('images/qris.png') }}"
                     class="w-72 mx-auto border rounded-2xl p-3 shadow-sm">

            </div>

        @endif

    </div>

    <!-- UPLOAD BUKTI PEMBAYARAN -->
<div class="mt-6 border rounded-2xl p-6">

    <h3 class="font-semibold text-gray-700 mb-4">
        Upload Bukti Pembayaran
    </h3>

    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-4">
            {{ session('success') }}
        </div>

    @endif

    <form method="POST"
          action="{{ route('booking.upload', $booking->id) }}"
          enctype="multipart/form-data">

        @csrf

        <!-- FILE -->
        <div>

            <label class="text-sm text-gray-600 block mb-2">
                Foto Bukti Transfer
            </label>

            <input type="file"
                   name="bukti"
                   accept="image/*"
                   required
                   class="w-full border rounded-xl p-3">

        </div>

        <!-- ERROR -->
        @error('bukti')

            <p class="text-red-500 text-sm mt-2">
                {{ $message }}
            </p>

        @enderror

        <!-- BUTTON -->
        <button type="submit"
                class="mt-5 w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl transition">

            Upload Bukti Pembayaran

        </button>

    </form>

    <!-- PREVIEW -->
    @if($booking->bukti_pembayaran)

        <div class="mt-6">

            <p class="text-sm text-gray-500 mb-3">
                Bukti pembayaran yang telah diupload:
            </p>

            <img src="{{ asset('storage/' . $booking->bukti_pembayaran) }}"
                 class="w-72 rounded-2xl border shadow">

        </div>

    @endif

</div>

    <!-- INFORMASI VERIFIKASI -->
    <div class="mt-6 border border-blue-200 bg-blue-50 rounded-2xl p-5">

        <div class="flex items-start gap-4">

            <!-- ICON -->
            <div class="bg-blue-100 text-blue-700 rounded-full p-2">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M12 8v.01" />

                </svg>

            </div>

            <!-- TEXT -->
            <div>

                <h4 class="font-semibold text-blue-800 mb-2">
                    Menunggu Verifikasi Admin
                </h4>

                <p class="text-sm text-blue-700 leading-relaxed">

                    Setelah melakukan pembayaran,
                    admin akan memverifikasi pembayaran Anda terlebih dahulu
                    sebelum booking disetujui.

                </p>

                <div class="mt-3 text-sm text-blue-800 space-y-1">

                    <p>
                        • Verifikasi maksimal 1 x 24 jam
                    </p>

                    <p>
                        • Pastikan nominal pembayaran sesuai
                    </p>

                    <p>
                        • Simpan bukti transfer pembayaran
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- STATUS -->
    <div class="mt-6 border rounded-2xl p-5 bg-gray-50">

        <div class="flex flex-col md:flex-row justify-between items-center gap-4">

            <!-- STATUS -->
            <div>

                <p class="text-sm text-gray-500 mb-2">
                    Status Booking
                </p>

                @if($booking->status == 'pending')

                    <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">
                        Pending Pembayaran
                    </span>

                @elseif($booking->status == 'menunggu_verifikasi')

                    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                        Menunggu Verifikasi
                    </span>

                @elseif($booking->status == 'approved')

                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                        Pembayaran Disetujui
                    </span>

                @else

                    <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
                        Pembayaran Ditolak
                    </span>

                @endif

            </div>

            <!-- BUTTON -->
            <a href="{{ route('kontrakan.show', $booking->kontrakan->id) }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-xl transition">

                ← Kembali

            </a>

        </div>

    </div>

</div>

@endsection