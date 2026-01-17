<?php

namespace App\Livewire\Hospital\Home;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $stats = [];

    public function render()
    {
        $user = Auth::user();
        $hospitalId = $user->hospital_id;

        // Redirect if not a hospital user
        if (!$user->isHospital() || !$hospitalId) {
            abort(403, 'Unauthorized access.');
        }

        $hospital = $user->hospital;

        $this->stats = [
            'total_members' => User::where('hospital_id', $hospitalId)->count(),
            'pending_verifications' => User::where('hospital_id', $hospitalId)
                ->where('application_status', 'pending')->count(),
            'active_members' => User::where('hospital_id', $hospitalId)
                ->where('application_status', 'approved')
                ->where('is_verified', true)->count(),
            'recent_patients' => User::where('hospital_id', $hospitalId)
                ->latest()
                ->take(5)
                ->get(),
        ];

        return view('livewire.hospital.home.index', [
            'hospital' => $hospital
        ]);
    }
}
