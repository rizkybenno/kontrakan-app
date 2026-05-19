@extends('layouts.app')

@section('content')

@php
$fotos = is_string($kontrakan->fotos)
    ? json_decode($kontrakan->fotos, true)
    : ($kontrakan->fotos ?? []);

$myReview = auth()->check()
    ? $kontrakan->reviews->where('user_id', auth()->id())->first()
    : null;

$isAdmin = auth()->check() && auth()->user()->is_admin;
@endphp

<div class="max-w-5xl mx-auto bg-white rounded-xl shadow p-6">

{{-- ================= SLIDER ================= --}}
<div class="relative">
    <img id="mainImage"
         src="{{ asset('storage/'.($fotos[0]['path'] ?? 'default.jpg')) }}"
         class="w-full h-[420px] object-contain bg-gray-100 rounded-lg cursor-zoom-in"
         onclick="openImageModal(this.src)">

    @if(count($fotos) > 1)
        <button onclick="prevImage()" class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/50 text-white px-3 py-2 rounded-full">‹</button>
        <button onclick="nextImage()" class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/50 text-white px-3 py-2 rounded-full">›</button>
    @endif
</div>

{{-- THUMBNAIL --}}
@if(count($fotos))
<div class="flex gap-2 mt-4 overflow-x-auto">
    @foreach($fotos as $i => $foto)
        <img src="{{ asset('storage/'.$foto['path']) }}"
             class="w-20 h-16 object-cover rounded border cursor-pointer hover:opacity-70"
             onclick="setImage({{ $i }})">
    @endforeach
</div>
@endif

{{-- ================= INFO ================= --}}
<div class="mt-6">
    <h2 class="text-2xl font-bold text-gray-800">{{ $kontrakan->nama }}</h2>
    <p class="text-gray-500 text-sm mt-1">📍 {{ $kontrakan->alamat }}</p>

    <p class="text-amber-700 text-xl font-bold mt-4">
        Rp {{ number_format($kontrakan->harga,0,',','.') }} / bulan
    </p>

    <div class="mt-4 text-gray-600 text-sm">
    {{ $kontrakan->deskripsi }}
</div>



<a href="{{ url('/booking/'.$kontrakan->id) }}"
   class="block mt-6 text-center bg-amber-700 text-white py-3 rounded-lg hover:bg-amber-800">
    Booking Sekarang
</a>
</div>

{{-- ================= REVIEW FORM ================= --}}
<div class="mt-10 bg-white p-6 rounded-xl shadow">

<h3 class="text-lg font-bold mb-4">Review</h3>

@auth
@if(!$myReview)
<form action="{{ route('review.store') }}" method="POST" class="mb-6">
    @csrf
    <input type="hidden" name="kontrakan_id" value="{{ $kontrakan->id }}">

    <select name="rating" class="w-full border p-2 rounded mb-3">
        @for($i=5;$i>=1;$i--)
            <option value="{{ $i }}">{{ $i }} ★</option>
        @endfor
    </select>

    <textarea name="komentar" class="w-full border p-2 rounded mb-3" placeholder="Tulis review..."></textarea>

    <button class="bg-amber-700 text-white px-4 py-2 rounded w-full">
        Kirim Review
    </button>
</form>
@endif
@endauth

{{-- ================= LIST REVIEW ================= --}}
<div class="space-y-3">

@forelse($kontrakan->reviews as $r)

@php
$isMine = auth()->check() && $r->user_id == auth()->id();
@endphp

<div class="border-b pb-3 p-3 rounded hover:bg-gray-50">

    <div class="flex justify-between items-start">

        <div>
            <div class="font-semibold text-sm">{{ $r->user->name }}</div>
            <div class="text-yellow-500 text-sm">⭐ {{ $r->rating }}/5</div>
        </div>

        {{-- DROPDOWN --}}
        <div class="relative">

            <button type="button"
                    onclick="toggleMenu(event, {{ $r->id }})"
                    class="text-gray-500 hover:text-black text-xl px-2">
                ⋮
            </button>

            <div id="menu-{{ $r->id }}"
                 class="hidden absolute right-0 mt-2 w-36 bg-white border rounded-lg shadow-lg z-50">

                {{-- REPORT (HANYA REVIEW ORANG LAIN) --}}
@if(!$isMine)
<button type="button"
        onclick="openReportModal({{ $r->id }})"
        class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-gray-100">
    🚨 Report
</button>
@endif


                {{-- DELETE --}}
                @if($isMine || $isAdmin)
                <form action="{{ route('review.destroy', $r->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        🗑 Hapus
                    </button>
                </form>
                @endif

            </div>
        </div>

    </div>

    <p class="text-gray-600 text-sm mt-2">
        {{ $r->komentar }}
    </p>

</div>

@empty
<p class="text-gray-400 text-sm">Belum ada review</p>
@endforelse

</div>
</div>

</div>

{{-- ================= IMAGE MODAL ================= --}}
<div id="imageModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50">
    <img id="modalImg" class="max-w-3xl max-h-[90vh] rounded">
</div>

{{-- ================= REVIEW MODAL ================= --}}
<div id="reviewModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

<div class="bg-white w-full max-w-md p-5 rounded-lg">

    <form id="editReviewForm" method="POST">
        @csrf
        @method('PUT')

        <select name="rating" id="modalRating" class="w-full border p-2 rounded mb-3">
            @for($i=5;$i>=1;$i--)
                <option value="{{ $i }}">{{ $i }} ★</option>
            @endfor
        </select>

        <textarea name="komentar" id="modalKomentar"
                  class="w-full border p-2 rounded mb-3"></textarea>

        <button class="bg-amber-700 text-white w-full py-2 rounded">
            Update
        </button>
    </form>

</div>
</div>

{{-- ================= REPORT MODAL ================= --}}
<div id="reportModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

<div class="bg-white w-full max-w-md p-5 rounded-lg relative">

    <button type="button"
            onclick="closeReportModal()"
            class="absolute top-3 right-3 text-gray-500 hover:text-black">
        ✖
    </button>

    <h3 class="text-lg font-bold mb-4">Report Review</h3>

    <form id="reportForm" method="POST">
        @csrf

        <input type="hidden" name="review_id" id="reportReviewId">

        <select name="alasan" class="w-full border p-2 rounded mb-3" required>
            <option value="">Pilih alasan</option>
            <option value="spam">Spam</option>
            <option value="kasar">Bahasa kasar</option>
            <option value="tidak_relevan">Tidak relevan</option>
            <option value="penipuan">Penipuan</option>
            <option value="lainnya">Lainnya</option>
        </select>

        <button class="bg-red-600 text-white w-full py-2 rounded">
            Kirim Report
        </button>
    </form>

</div>
</div>

{{-- ================= SCRIPT ================= --}}
<script>

let images = @json($fotos);
let index = 0;

/* IMAGE */
function setImage(i){
    index = i;
    document.getElementById('mainImage').src = '/storage/' + images[i].path;
}

function nextImage(){
    index = (index + 1) % images.length;
    setImage(index);
}

function prevImage(){
    index = (index - 1 + images.length) % images.length;
    setImage(index);
}

function openImageModal(src){
    const modal = document.getElementById('imageModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.getElementById('modalImg').src = src;
}

document.getElementById('imageModal').onclick = function(){
    this.classList.add('hidden');
    this.classList.remove('flex');
};

/* DROPDOWN */
function toggleMenu(event, id){
    event.stopPropagation();

    document.querySelectorAll('[id^="menu-"]').forEach(el => {
        if (el.id !== 'menu-' + id) el.classList.add('hidden');
    });

    document.getElementById('menu-' + id).classList.toggle('hidden');
}

document.addEventListener('click', function(){
    document.querySelectorAll('[id^="menu-"]').forEach(el => {
        el.classList.add('hidden');
    });
});

/* REVIEW MODAL */
function openReviewModal(id, komentar, rating){
    const modal = document.getElementById('reviewModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('modalKomentar').value = komentar;
    document.getElementById('modalRating').value = rating;

    document.getElementById('editReviewForm').action = '/review/' + id;
}

/* REPORT MODAL */
function openReportModal(reviewId){
    const modal = document.getElementById('reportModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('reportReviewId').value = reviewId;

    document.getElementById('reportForm').action = '/review/report';
}

function closeReportModal(){
    const modal = document.getElementById('reportModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

</script>

@endsection