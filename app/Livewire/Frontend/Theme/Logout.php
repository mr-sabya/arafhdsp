<?php

namespace App\Livewire\Frontend\Theme;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout();

        // সেশন ইনভ্যালিডেট করা এবং সিএসআরএফ টোকেন রিসেট করা (নিরাপত্তার জন্য)
        Session::invalidate();
        Session::regenerateToken();

        // লগআউটের পর হোমপেজে বা লগইন পেজে রিডাইরেক্ট
        return $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.frontend.theme.logout');
    }
}
