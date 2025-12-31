<?php

namespace App\Livewire\Worker\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $users = User::where('referred_by', Auth::user()->id)
            ->whereHas('role', function ($q) {
                $q->where('slug', 'member');
            })
            ->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('mobile', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.worker.user.index', [
            'users' => $users
        ]);
    }
}
