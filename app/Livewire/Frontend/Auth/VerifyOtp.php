<?php

namespace App\Livewire\Frontend\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class VerifyOtp extends Component
{
    public $mobile;
    public $otp_input;
    public $display_otp; // Just for showing on screen as requested

    public function mount($mobile)
    {
        $this->mobile = $mobile;
        // Retrieve the flashed OTP from session
        $this->display_otp = session('temp_otp');
    }

    public function verify()
    {
        $user = User::where('mobile', $this->mobile)->first();

        if (!$user || $user->otp !== $this->otp_input) {
            session()->flash('error', 'ভুল ওটিপি (OTP), আবার চেষ্টা করুন।');
            return;
        }

        if (now()->gt($user->otp_expires_at)) {
            session()->flash('error', 'ওটিপি (OTP) এর মেয়াদ শেষ হয়ে গেছে।');
            return;
        }

        // Mark as verified
        $user->update([
            'is_verified' => true,
            'otp' => null, // Clear OTP after success
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'আপনার অ্যাকাউন্ট সফলভাবে যাচাই করা হয়েছে।');
    }

    public function render()
    {
        return view('livewire.frontend.auth.verify-otp');
    }
}
