<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewReport;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // ================= STORE (CREATE / UPDATE 1 USER 1 REVIEW) =================
    public function store(Request $request)
    {
        $request->validate([
            'kontrakan_id' => 'required|exists:kontrakans,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        Review::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'kontrakan_id' => $request->kontrakan_id,
            ],
            [
                'rating' => $request->rating,
                'komentar' => $request->komentar,
            ]
        );

        return back()->with('success', 'Review berhasil disimpan');
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
{
    $review = Review::findOrFail($id);

    if ($review->user_id !== auth()->id() && !auth()->user()->is_admin) {
        abort(403);
    }

    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'komentar' => 'required|string'
    ]);

    $review->update([
        'rating' => $request->rating,
        'komentar' => $request->komentar,
    ]);

    return back()->with('success', 'Review berhasil diupdate');
}

    // ================= DELETE =================
    public function destroy($id)
{
    $review = Review::findOrFail($id);

    if ($review->user_id !== auth()->id() && !auth()->user()->is_admin) {
        abort(403);
    }

    $review->delete();

    return back()->with('success', 'Review berhasil dihapus');
}

    // ================= REPORT REVIEW =================
    public function report(Request $request)
{
    if (!auth()->check()) {
        abort(403);
    }

    $request->validate([
        'review_id' => 'required|exists:reviews,id',
        'alasan' => 'required|in:spam,kasar,tidak_relevan,penipuan,lainnya',
    ]);

    $exists = ReviewReport::where('review_id', $request->review_id)
        ->where('user_id', auth()->id())
        ->exists();

    if ($exists) {
        return back()->with('error', 'Kamu sudah melaporkan review ini.');
    }

    ReviewReport::create([
        'review_id' => $request->review_id,
        'user_id' => auth()->id(),
        'alasan' => $request->alasan,
    ]);

    return back()->with('success', 'Review berhasil dilaporkan');
}}
