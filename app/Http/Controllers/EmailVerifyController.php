<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmailVerifyController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email address.']);
        }

        // Generate OTP
        $otp = Str::random(6); // Generate a 6-character random OTP
        $user->otp = $otp; // Store OTP in the database (make sure to add 'otp' column in users table)
        $user->save();

        // Send email with OTP
        Mail::to($user->email)->send(new EmailVerify());

        return back()->with('status', 'OTP has been sent to your email address.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP or email.']);
        }

        // Update the isVerified field to 1
        $user->isVerified = 1;
        $user->otp = null; // Clear OTP after verification
        $user->save();

        return redirect()->route('dashboard')->with('status', 'Email verified successfully!');
    }
}
