@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto bg-white rounded-xl shadow p-6">

    {{-- ================= HEADER ================= --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Report Management</h1>
        <p class="text-sm text-gray-500">
            Kelola laporan review dari pengguna.
        </p>
    </div>

    {{-- ================= TABLE ================= --}}
    <div class="overflow-x-auto">

        <table class="w-full border text-sm">

            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3 border">Pelapor</th>
                    <th class="p-3 border">Pemilik Review</th>
                    <th class="p-3 border">Alasan</th>
                    <th class="p-3 border">Komentar Review</th>
                    <th class="p-3 border">Tanggal</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($reports as $report)

                <tr class="border-t hover:bg-gray-50">

                    {{-- PELAPOR --}}
                    <td class="p-3 border">
                        {{ $report->user->name }}
                    </td>

                    {{-- PEMILIK REVIEW --}}
                    <td class="p-3 border">
                        {{ $report->review->user->name }}
                    </td>

                    {{-- ALASAN --}}
                    <td class="p-3 border">
                        <span class="px-2 py-1 rounded text-xs bg-red-100 text-red-700">
                            {{ $report->alasan }}
                        </span>
                    </td>

                    {{-- KOMENTAR --}}
                    <td class="p-3 border text-gray-600">
                        {{ $report->review->komentar }}
                    </td>

                    {{-- TANGGAL --}}
                    <td class="p-3 border text-gray-500">
                        {{ $report->created_at->format('d M Y H:i') }}
                    </td>

                    {{-- AKSI --}}
                    <td class="p-3 border flex gap-2">

                        {{-- HAPUS REVIEW --}}
                        <form action="{{ route('review.destroy', $report->review->id) }}" method="POST"
                              onsubmit="return confirm('Hapus review ini?')">
                            @csrf
                            @method('DELETE')

                            <button class="bg-red-600 text-white px-3 py-1 rounded text-xs">
                                Hapus Review
                            </button>
                        </form>

                        {{-- IGNORE REPORT --}}
                        <form action="{{ route('report.delete', $report->id) }}" method="POST"
                              onsubmit="return confirm('Ignore report ini?')">
                            @csrf
                            @method('DELETE')

                            <button class="bg-gray-500 text-white px-3 py-1 rounded text-xs">
                                Ignore
                            </button>
                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center p-6 text-gray-400">
                        Belum ada report
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection