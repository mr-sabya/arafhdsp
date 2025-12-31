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

        if (Auth::attempt(['mobile' => $this->phone, 'password' => $this->password], $this->remember)) {
            session()->flash('success', 'সফলভাবে লগইন হয়েছে!');

            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Logic to redirect based on Role Slug
            return $this->redirectBasedOnRole($user);
        }

        throw ValidationException::withMessages([
            'phone' => 'আপনার দেওয়া তথ্যগুলো আমাদের রেকর্ডের সাথে মিলছে না।',
        ]);
    }

    /**
     * Handle redirection logic based on user role
     */
    protected function redirectBasedOnRole($user)
    {
        // 1. Role Based Redirection
        $route = match ($user->role->slug) {
            'worker'     => route('worker.dashboard'),
            'hospital'   => route('hospital.dashboard'),
            'diagnostic' => route('diagnostic.dashboard'),
            'dealer'     => route('dealer.dashboard'),
            'member'     => route('user.dashboard'), // Regular Member
            default      => route('user.dashboard'),
        };

        return $this->redirectIntended($route, navigate: true);
    }

    public function render()
    {
        return view('livewire.frontend.auth.login');
    }
}
