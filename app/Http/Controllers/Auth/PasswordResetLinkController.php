<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Form forgot password
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle request reset password
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
        ]);

        // 🔥 kirim email reset password (default Laravel)
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // 🔥 format nomor WA (08 -> 62)
        $phone = preg_replace('/^0/', '62', $request->phone);

        // 🔥 link reset password Laravel
        $link = url('/reset-password');

        // 🔥 pesan WhatsApp
        $message = "Halo, berikut link reset password Anda:\n$link";

        $waUrl = "https://wa.me/$phone?text=" . urlencode($message);

        // kalau email sukses → arahkan ke WA
        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->away($waUrl);
        }

        return back()
            ->withInput($request->only('email', 'phone'))
            ->withErrors(['email' => __($status)]);
    }
}