<?php

namespace App\Http\Controllers\TwoFA;

use App\Http\Controllers\Controller;
use PragmaRX\Google2FAQRCode\Google2FA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TwoFactorAuthController extends Controller
{
    public function enable2fa(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $google2fa = new Google2FA();

        // Generate a new secret
        $user->google2fa_secret = $google2fa->generateSecretKey();
        $user->save();

        // Generate QR code URL
        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        return view('auth.enable_2fa', ['QR_Image' => $QR_Image, 'secret' => $user->google2fa_secret]);
    }

    public function verify2fa(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->input('one_time_password'));

        if ($valid) {
            $user->two_fa_enabled = true;
            $user->save();
            return redirect()->route('home')->with('success', '2FA enabled successfully.');
        }

        return back()->with('error', 'Invalid OTP. Please try again.');
    }
}
