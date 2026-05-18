@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto bg-white rounded-xl shadow p-6">

    <!-- JUDUL -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Booking Kontrakan
        </h2>

        <p class="text-gray-500">
            Kontrakan:
            <span class="font-semibold text-amber-700">
                {{ $kontrakan->nama }}
            </span>
        </p>
    </div>

    <!-- ERROR -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-5">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- ================= FORM BOOKING ================= -->
    <div class="border rounded-xl p-5 bg-gray-50 mb-8">

        <h3 class="font-semibold text-gray-700 mb-4">
            Form Booking
        </h3>

        <form method="POST" action="{{ route('booking.store') }}">
            @csrf

            <input type="hidden"
                   name="kontrakan_id"
                   value="{{ $kontrakan->id }}">

            <!-- NO HP -->
            <div class="mb-4">
                <label class="text-sm text-gray-600">
                    Nomor HP / WhatsApp
                </label>

                <input type="text"
                       name="no_hp"
                       value="{{ old('no_hp') }}"
                       class="w-full border rounded px-3 py-2 mt-1"
                       required>
            </div>

            <!-- TANGGAL MULAI -->
            <div class="mb-4">
                <label class="text-sm text-gray-600">
                    Tanggal Mulai Sewa
                </label>

                <input type="date"
                       name="tanggal_mulai"
                       id="tanggal_mulai"
                       value="{{ old('tanggal_mulai') }}"
                       class="w-full border rounded px-3 py-2 mt-1"
                       required>
            </div>

            <!-- TANGGAL SELESAI -->
            <div class="mb-4">
                <label class="text-sm text-gray-600">
                    Tanggal Selesai Sewa
                </label>

                <input type="date"
                       name="tanggal_selesai"
                       id="tanggal_selesai"
                       value="{{ old('tanggal_selesai') }}"
                       class="w-full border rounded px-3 py-2 mt-1"
                       required>
            </div>

            <!-- LAMA SEWA -->
            <div class="mb-4">
                <label class="text-sm text-gray-600">
                    Lama Sewa
                </label>

                <input type="text"
                       id="lama_sewa"
                       class="w-full border rounded px-3 py-2 mt-1 bg-gray-100"
                       readonly>
            </div>

            <!-- TOTAL -->
            <div class="mb-5">
                <label class="text-sm text-gray-600">
                    Total Bayar
                </label>

                <input type="text"
                       id="total_bayar"
                       class="w-full border rounded px-3 py-2 mt-1 bg-gray-100"
                       readonly>
            </div>

            <!-- METODE PEMBAYARAN -->
            <div class="mb-6">

                <label class="text-sm text-gray-600 block mb-3">
                    Metode Pembayaran
                </label>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <!-- BCA -->
                    <label class="cursor-pointer">
                        <input type="radio"
                               name="metode"
                               value="bca"
                               class="hidden peer"
                               required>

                        <div class="border rounded-xl p-4 text-center
                                    peer-checked:border-amber-700
                                    peer-checked:bg-amber-50
                                    hover:shadow transition">

                            <p class="font-semibold text-gray-800">
                                Bank BCA
                            </p>

                            <p class="text-sm text-gray-500 mt-1">
                                Transfer BCA
                            </p>

                        </div>
                    </label>

                    <!-- BSI -->
                    <label class="cursor-pointer">
                        <input type="radio"
                               name="metode"
                               value="bsi"
                               class="hidden peer">

                        <div class="border rounded-xl p-4 text-center
                                    peer-checked:border-amber-700
                                    peer-checked:bg-amber-50
                                    hover:shadow transition">

                            <p class="font-semibold text-gray-800">
                                Bank BSI
                            </p>

                            <p class="text-sm text-gray-500 mt-1">
                                Transfer BSI
                            </p>

                        </div>
                    </label>

                    <!-- QRIS -->
                    <label class="cursor-pointer">
                        <input type="radio"
                               name="metode"
                               value="qris"
                               class="hidden peer">

                        <div class="border rounded-xl p-4 text-center
                                    peer-checked:border-amber-700
                                    peer-checked:bg-amber-50
                                    hover:shadow transition">

                            <p class="font-semibold text-gray-800">
                                QRIS
                            </p>

                            <p class="text-sm text-gray-500 mt-1">
                                Scan QR
                            </p>

                        </div>
                    </label>

                </div>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="w-full bg-amber-700 text-white py-3 rounded-lg hover:bg-amber-800 transition">

                Lanjut ke Pembayaran

            </button>

        </form>
    </div>

    <!-- ================= RIWAYAT ================= -->
    <div>

        <h3 class="font-semibold text-gray-700 mb-4">
            Riwayat Booking
        </h3>

        @forelse($bookings as $booking)

            <div class="border rounded-lg p-4 mb-3">

                <div class="flex justify-between items-center">

                    <div>
                        <p class="font-semibold text-gray-800">
                            Booking #{{ $booking->id }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $booking->tanggal_mulai }}
                            →
                            {{ $booking->tanggal_selesai }}
                        </p>
                    </div>

                    <div>
                        @if($booking->status == 'pending')

                            <span class="px-3 py-1 rounded bg-yellow-100 text-yellow-700 text-xs">
                                Pending
                            </span>

                        @elseif($booking->status == 'approved')

                            <span class="px-3 py-1 rounded bg-green-100 text-green-700 text-xs">
                                Approved
                            </span>

                        @else

                            <span class="px-3 py-1 rounded bg-red-100 text-red-700 text-xs">
                                Rejected
                            </span>

                        @endif
                    </div>

                </div>

            </div>

        @empty

            <div class="text-gray-500 text-center py-6">
                Belum ada booking
            </div>

        @endforelse

    </div>

</div>

<script>

    const harga = {{ $kontrakan->harga }};

    const tanggalMulai =
        document.getElementById('tanggal_mulai');

    const tanggalSelesai =
        document.getElementById('tanggal_selesai');

    const lamaSewa =
        document.getElementById('lama_sewa');

    const totalBayar =
        document.getElementById('total_bayar');

    function hitungBooking() {

        if(tanggalMulai.value && tanggalSelesai.value) {

            let mulai = new Date(tanggalMulai.value);
            let selesai = new Date(tanggalSelesai.value);

            // SELISIH HARI
            let selisihHari =
                (selesai - mulai) / (1000 * 60 * 60 * 24);

            // BULATKAN KE ATAS
            let bulan =
                Math.ceil(selisihHari / 30);

            // MINIMAL 1 BULAN
            if(bulan < 1) {
                bulan = 1;
            }

            lamaSewa.value =
                bulan + ' bulan';

            let total = harga * bulan;

            totalBayar.value =
                'Rp ' + total.toLocaleString('id-ID');
        }
    }

    tanggalMulai.addEventListener('change', hitungBooking);
    tanggalSelesai.addEventListener('change', hitungBooking);

</script>

@endsection