<?php

namespace App\Livewire\Worker\User;

use App\Models\User;
use App\Models\PaymentMethod;
use Livewire\Component;

class ProcessPayment extends Component
{
    public $user, $paymentMethods, $selectedMethod, $transactionId;

    public function mount($user_id)
    {
        $this->user = User::with('pricingPlan')->findOrFail($user_id);
        $this->paymentMethods = PaymentMethod::where('status', true)->get();
    }

    public function selectMethod($id) { $this->selectedMethod = PaymentMethod::find($id); }

    public function submitPayment()
    {
        $this->validate(['transactionId' => 'required|min:6', 'selectedMethod' => 'required']);

        $this->user->update([
            'payment_method' => $this->selectedMethod->slug,
            'transaction_id' => $this->transactionId,
            'payment_status' => 'pending',
        ]);

        session()->flash('success', 'সদস্য নিবন্ধন ও পেমেন্ট তথ্য সম্পন্ন হয়েছে।');
        return $this->redirect(route('worker.user.index'), navigate: true); // মেম্বার লিস্টে ফিরে যান
    }

    public function render()
    {
        return view('livewire.worker.user.process-payment');
    }
}