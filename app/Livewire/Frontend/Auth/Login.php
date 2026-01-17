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
        $roleSlug = $user->role->slug;

        // 1. Determine the Route
        $route = match ($roleSlug) {
            'worker'     => route('worker.dashboard'),
            'hospital'   => route('hospital.dashboard'),
            'diagnostic' => route('diagnostic.dashboard'),
            'dealer'     => route('dealer.dashboard'),
            'member'     => route('user.dashboard'),
            default      => route('user.dashboard'),
        };

        // 2. Check if it's a member to apply SPA navigation
        if ($roleSlug === 'member') {
            return $this->redirectIntended($route, navigate: true);
        }

        // 3. For all other roles, perform a standard full-page redirect
        return $this->redirectIntended($route);
    }

    public function render()
    {
        return view('livewire.frontend.auth.login');
    }
}
