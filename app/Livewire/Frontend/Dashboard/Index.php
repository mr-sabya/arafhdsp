<?php

namespace App\Livewire\Frontend\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public function render()
    {
        $user = Auth::user();
        return view('livewire.frontend.dashboard.index', [
            'user' => $user
        ]); // আপনার মেইন লেআউট ফাইল
    }
}
