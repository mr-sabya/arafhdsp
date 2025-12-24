<?php

namespace App\Livewire\Frontend\Payment;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PaymentStatus extends Component
{
    public function render()
    {
        return view('livewire.frontend.payment.payment-status');
    }
}
