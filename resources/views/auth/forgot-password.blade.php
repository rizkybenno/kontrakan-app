@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold text-center mb-4">
        Lupa Password
    </h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 mb-4 rounded">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('status'))
        <div class="bg-green-100 text-green-600 p-3 mb-4 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- EMAIL -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">Email</label>
            <input type="email" name="email"
                   class="w-full border p-2 rounded mt-1"
                   required>
        </div>

        <!-- WHATSAPP -->
        <div class="mb-4">
            <label class="text-sm text-gray-600">No WhatsApp</label>
            <input type="text" name="phone"
                   placeholder="08xxxxxxxxxx"
                   class="w-full border p-2 rounded mt-1"
                   required>
        </div>

        <button type="submit"
                class="w-full bg-amber-700 text-white py-2 rounded hover:bg-amber-800">
            Kirim Link Reset
        </button>

    </form>

</div>

@endsection