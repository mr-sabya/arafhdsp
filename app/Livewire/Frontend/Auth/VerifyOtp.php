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
        $user = User::where('mobile', $mobile)->first();
        $this->display_otp = $user->otp;
    }

    public function verify()
    {
        $user = User::where('mobile', $this->mobile)->first();

        // ১. ইউজার আছে কি না এবং ওটিপি মিলছে কি না চেক করুন
        if (!$user || $user->otp !== $this->otp_input) {
            session()->flash('error', 'ভুল ওটিপি (OTP), আবার চেষ্টা করুন।');
            return;
        }

        // ২. মেয়াদ শেষ হয়েছে কি না চেক করুন (Null চেকসহ)
        // যদি otp_expires_at না থাকে অথবা বর্তমান সময় মেয়াদের চেয়ে বেশি হয়
        if (!$user->otp_expires_at || now()->gt($user->otp_expires_at)) {
            session()->flash('error', 'ওটিপি (OTP) এর মেয়াদ শেষ হয়ে গেছে। আবার ওটিপি পাঠান।');
            return;
        }

        // ৩. ভেরিফিকেশন সফল হলে
        $user->update([
            'is_verified' => true,
            'otp' => null,
            'otp_expires_at' => null, // মেয়াদও ক্লিয়ার করে দিন
        ]);

        Auth::login($user);

        session()->flash('success', 'আপনার অ্যাকাউন্ট সফলভাবে যাচাই করা হয়েছে।');

        return $this->redirectRoute('payment', navigate: true);
    }

    public function render()
    {
        return view('livewire.frontend.auth.verify-otp');
    }
}
