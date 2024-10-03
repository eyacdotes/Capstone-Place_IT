<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class OtpVerifyController extends Controller
{
    public function store(Request $request)
    {
        // Logic to generate and send the OTP via email
        $user = auth()->user();
        $otp = rand(100000, 999999); // Generate a random 6-digit OTP

        // Store OTP in session or database as necessary
        $request->session()->put('otp', $otp);
        // Send OTP email
        Mail::to($user->email)->send(new SendOtpMail($otp));

        return redirect()->route('otp.verify')->with('status', 'OTP has been sent to your email address.');
    }

    public function verifyOtp(Request $request)
    {
        // Check if OTP matches
        if ($request->input('otp') == $request->session()->get('otp')) {
            // Update user's isVerified status
            $user = Auth::user();
            $user->isVerified = 1; // Set to true
            $user->save();

            // Clear the OTP from session
            $request->session()->forget('otp');

            // Redirect to the dashboard
            return redirect()->route('dashboard')->with('success', 'Email verified successfully!');
        }

        return redirect()->route('otp.verify')->with('error', 'Invalid OTP.');
    }
}
