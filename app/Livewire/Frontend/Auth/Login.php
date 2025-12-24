<?php

namespace App\Livewire\Frontend\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $phone;
    public $password;
    public $remember = false;

    protected $rules = [
        'phone' => 'required|numeric|digits:11',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        // মোবাইল নম্বর দিয়ে লগইন চেষ্টা (আপনার কলামের নাম mobile হলে এখানে mobile দিন)
        if (Auth::attempt(['mobile' => $this->phone, 'password' => $this->password], $this->remember)) {
            session()->flash('success', 'সফলভাবে লগইন হয়েছে!');
            return $this->redirectIntended(route('user.dashboard'), navigate: true);
        }

        throw ValidationException::withMessages([
            'phone' => 'আপনার দেওয়া তথ্যগুলো আমাদের রেকর্ডের সাথে মিলছে না।',
        ]);
    }

    public function render()
    {
        return view('livewire.frontend.auth.login');
    }
}
