<?php

namespace App\Livewire\Worker\User;

use App\Models\User;
use Livewire\Component;

class VerifyOtp extends Component
{
    public $userId, $user, $otp_input;

    public function mount($user_id)
    {
        $this->userId = $user_id;
        $this->user = User::findOrFail($user_id);
    }

    public function verify()
    {
        if ($this->user->otp !== $this->otp_input) {
            session()->flash('error', 'ভুল ওটিপি! আবার চেষ্টা করুন।');
            return;
        }

        $this->user->update([
            'is_verified' => true,
            'otp' => null,
        ]);

        session()->flash('success', 'মোবাইল নম্বর সফলভাবে যাচাই করা হয়েছে।');
        return $this->redirect(route('worker.user.payment', ['user_id' => $this->userId]), navigate: true);
    }

    public function render()
    {
        return view('livewire.worker.user.verify-otp');
    }
}
