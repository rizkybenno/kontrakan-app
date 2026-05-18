@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Manajemen Akun</h2>

    {{-- NOTIF --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="space-y-3">

        @forelse($users as $u)
        <div class="bg-white p-4 rounded shadow flex justify-between items-center">

            <div>
                <p class="font-semibold">{{ $u->name }}</p>
                <p class="text-sm text-gray-500">{{ $u->email }}</p>
            </div>

            {{-- ❌ JANGAN TAMPILKAN DELETE UNTUK DIRI SENDIRI --}}
            @if($u->id !== auth()->id())
            <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button onclick="return confirm('Hapus akun ini?')"
                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                    Hapus
                </button>
            </form>
            @endif

        </div>
        @empty
            <p class="text-gray-500">Tidak ada user</p>
        @endforelse

    </div>

    <!-- BACK BUTTON (FIXED & RAPI) -->
<div class="mt-8 flex justify-center">
    <a href="{{ route('admin.panel') }}"
       class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-300 transition shadow-sm">
        ← Kembali ke Admin Panel
    </a>
</div>

</div>

@endsection