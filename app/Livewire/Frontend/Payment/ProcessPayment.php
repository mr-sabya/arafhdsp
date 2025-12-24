<?php

namespace App\Livewire\Frontend\Payment;

use Livewire\Component;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;

class ProcessPayment extends Component
{
    public $user;
    public $paymentMethods;
    public $selectedMethod = null;
    public $transactionId;
    public $instruction = '';

    public function mount()
    {
        $this->user = Auth::user();

        // ইউজার যদি অলরেডি পেইড হয় তবে ড্যাশবোর্ডে পাঠিয়ে দিন
        if ($this->user->payment_status === 'paid') {
            return redirect()->route('dashboard');
        }

        $this->paymentMethods = PaymentMethod::where('status', true)->orderBy('sort_order')->get();
    }

    public function selectMethod($methodId)
    {
        $method = PaymentMethod::find($methodId);
        $this->selectedMethod = $method;
        $this->instruction = $method->instruction;
    }

    public function submitPayment()
    {
        $this->validate([
            'selectedMethod' => 'required',
            'transactionId' => 'required|min:8|unique:users,transaction_id',
        ], [
            'selectedMethod.required' => 'একটি পেমেন্ট মেথড সিলেক্ট করুন।',
            'transactionId.required' => 'ট্রানজেকশন আইডি লিখুন।',
            'transactionId.unique' => 'এই ট্রানজেকশন আইডিটি ইতিমধ্যে ব্যবহৃত হয়েছে।',
        ]);

        $this->user->update([
            'payment_method' => $this->selectedMethod->slug,
            'transaction_id' => $this->transactionId,
            'payment_status' => 'pending',
            'last_payment_date' => now(),
        ]);

        session()->flash('success', 'আপনার পেমেন্ট তথ্য জমা দেওয়া হয়েছে। এডমিন যাচাই করে আপনার অ্যাকাউন্টটি সক্রিয় করবেন।');

        return $this->redirect(route('payment.status'), navigate:true); // অথবা পেমেন্ট সাকসেস পেজ
    }

    public function render()
    {
        return view('livewire.frontend.payment.process-payment');
    }
}
