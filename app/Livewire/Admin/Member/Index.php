<?php

namespace App\Livewire\Admin\Member;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpen = false;
    public $selectedUser;

    // Form fields for update
    public $payment_status;
    public $application_status;
    public $admin_note;

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal($id)
    {
        $this->selectedUser = User::with(['pricingPlan', 'bloodGroup', 'division', 'district'])->findOrFail($id);
        $this->payment_status = $this->selectedUser->payment_status;
        $this->application_status = $this->selectedUser->application_status;
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['selectedUser', 'payment_status', 'application_status']);
    }

    public function updateStatus()
    {
        $this->validate([
            'payment_status' => 'required',
            'application_status' => 'required',
        ]);

        $this->selectedUser->update([
            'payment_status' => $this->payment_status,
            'application_status' => $this->application_status,
        ]);

        session()->flash('success', 'User status updated successfully.');
        $this->closeModal();
    }

    public function render()
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('slug','member');
        })
            // ২. সার্চ লজিকটি একটি ফাংশনের ভেতর রাখুন যাতে 'OR' কন্ডিশন মেম্বারদের ইনক্লুড না করে
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('mobile', 'like', '%' . $this->search . '%')
                    ->orWhere('transaction_id', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.member.index', [
            'users' => $users
        ]);
    }
}
