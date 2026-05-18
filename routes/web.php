<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KontrakanController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| 🌐 PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [KontrakanController::class, 'home'])->name('home');

/*
|--------------------------------------------------------------------------
| 🏠 KONTRAKAN PUBLIC
|--------------------------------------------------------------------------
*/
Route::prefix('kontrakan')->name('kontrakan.')->group(function () {

    // LIST KONTRAKAN
    Route::get('/', [KontrakanController::class, 'index'])->name('index');

    // DETAIL KONTRAKAN
    Route::get('/detail/{id}', [KontrakanController::class, 'show'])
        ->name('show');

    // DETAIL KAMAR
    Route::get('/detail/{kontrakan}/kamar/{kamar}',
        [KontrakanController::class, 'detailKamar'])
        ->name('kamar.detail');

    /*
    |--------------------------------------------------------------------------
    | 🔐 USER (AUTH REQUIRED)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {

        // 📌 PENGAJUAN KONTRAKAN
        Route::get('/pengajuan', [KontrakanController::class, 'pengajuan'])
            ->name('pengajuan');

        Route::post('/pengajuan', [KontrakanController::class, 'storePengajuan'])
            ->name('storePengajuan');

        // 🏠 KONTRAKAN USER
        Route::get('/saya', [KontrakanController::class, 'myKontrakan'])
            ->name('saya');

        // ✏️ EDIT KONTRAKAN USER
        Route::get('/saya/edit', [KontrakanController::class, 'editUserKontrakan'])
            ->name('user.edit');

        // 💾 UPDATE KONTRAKAN USER
        Route::put('/saya/update', [KontrakanController::class, 'updateUserKontrakan'])
            ->name('user.update');

    });
});

/*
|--------------------------------------------------------------------------
| 🔐 AUTH ROUTES
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| 👤 USER AREA (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ⭐ REVIEW SYSTEM
    |--------------------------------------------------------------------------
    */
    Route::prefix('review')->name('review.')->group(function () {

        Route::post('/', [ReviewController::class, 'store'])->name('store');
        Route::put('/{id}', [ReviewController::class, 'update'])->name('update');
        Route::delete('/{id}', [ReviewController::class, 'destroy'])->name('destroy');

        Route::post('/report', [ReviewController::class, 'report'])->name('report');
    });

    /*
    |--------------------------------------------------------------------------
    | 📦 BOOKING
    |--------------------------------------------------------------------------
    */
    Route::prefix('booking')->name('booking.')->group(function () {

        Route::get('/{id}', [BookingController::class, 'index'])->name('index');
        Route::post('/', [BookingController::class, 'store'])->name('store');
        Route::get('/pembayaran/{id}', [BookingController::class, 'pembayaran'])->name('pembayaran');
        Route::post('/upload/{id}',   [BookingController::class, 'uploadBukti'])   ->name('upload');
    });

    /*
    |--------------------------------------------------------------------------
    | 👤 PROFILE
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {

        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

/*
|--------------------------------------------------------------------------
| 🏠 DASHBOARD USER
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {

    $rekomendasi = \App\Models\Kontrakan::where('status_pengajuan', 'approved')
        ->latest()
        ->take(6)
        ->get();

    $punyaKontrakan = \App\Models\Kontrakan::where('user_id', auth()->id())
        ->exists();

    return view('dashboard', compact(
        'rekomendasi',
        'punyaKontrakan'
    ));

})->name('dashboard');

/*
|--------------------------------------------------------------------------
| 📄 STATIC PAGES
|--------------------------------------------------------------------------
*/
Route::view('/faq', 'syarat_ketentuan_faq.faq')->name('faq');
Route::view('/ketentuan', 'syarat_ketentuan_faq.ketentuan')->name('ketentuan');

/*
|--------------------------------------------------------------------------
| 🔥 ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | 🧭 ADMIN PANEL
        |--------------------------------------------------------------------------
        */
        Route::get('/panel', function () {

            return view('admin.adminpanel', [
                'kontrakans' => \App\Models\Kontrakan::latest()->get(),
                'pendingKontrakan' => \App\Models\Kontrakan::where('status_pengajuan', 'pending')->latest()->get(),
                'approvedKontrakan' => \App\Models\Kontrakan::where('status_pengajuan', 'approved')->latest()->get(),
                'users' => \App\Models\User::latest()->get(),
                'reports' => \App\Models\ReviewReport::with(['user', 'review.user'])->latest()->get(),
                'totalUsers' => \App\Models\User::count(),
                'totalKontrakan' => \App\Models\Kontrakan::count(),
                'totalBooking' => \App\Models\Booking::count(),

'bookingPending' => \App\Models\Booking::where('status', 'pending')->count(),

'bookingApproved' => \App\Models\Booking::where('status', 'approved')->count(),

'bookingRejected' => \App\Models\Booking::where('status', 'rejected')->count(),

'totalPembayaran' => \App\Models\Booking::whereNotNull('bukti_pembayaran')->count(),
            ]);

        })->name('panel');

        /*
        |--------------------------------------------------------------------------
        | 🏠 KONTRAKAN ADMIN CRUD
        |--------------------------------------------------------------------------
        */
        Route::prefix('kontrakan')->name('kontrakan.')->group(function () {

            Route::get('/', [AdminController::class, 'index'])->name('index');
            Route::get('/create', [AdminController::class, 'create'])->name('create');
            Route::post('/', [AdminController::class, 'store'])->name('store');

            Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('edit');
            Route::put('/{id}', [AdminController::class, 'update'])->name('update');
            Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');

            Route::delete('/{id}/foto', [AdminController::class, 'deleteFoto'])->name('deleteFoto');
            Route::post('/{id}/cover', [AdminController::class, 'setCover'])->name('cover');

            Route::post('/{id}/approve', [AdminController::class, 'approve'])->name('approve');
            Route::post('/{id}/reject', [AdminController::class, 'reject'])->name('reject');
        });

        /*
        |--------------------------------------------------------------------------
        | 👤 USER MANAGEMENT
        |--------------------------------------------------------------------------
        */
        Route::get('/users', [AdminController::class, 'users'])->name('users.index');
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');

       /*
|--------------------------------------------------------------------------
| 📦 BOOKING MANAGEMENT
|--------------------------------------------------------------------------
*/

Route::get('/booking',    [AdminController::class, 'booking'])    ->name('booking.index');
Route::put('/booking/{id}/approve',    [AdminController::class, 'approveBooking'])   ->name('booking.approve');
Route::put('/booking/{id}/reject',    [AdminController::class, 'rejectBooking'])    ->name('booking.reject');

        /*
        |--------------------------------------------------------------------------
        | 🚨 REPORT MANAGEMENT
        |--------------------------------------------------------------------------
        */
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports.index');
        Route::delete('/reports/{id}', [AdminController::class, 'deleteReport'])->name('reports.destroy');
    });