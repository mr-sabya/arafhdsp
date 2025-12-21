<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials, $this->remember)) {
            $user = Auth::user();

            // Redirect based on is_admin
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('dashboard');
        }

        $this->addError('email', 'Invalid login credentials.');
    }

    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
