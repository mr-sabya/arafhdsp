<?php

namespace App\Livewire\Admin\Home;

use Livewire\Component;
use App\Models\User;
use App\Models\Hospital;
use App\Models\PricingPlan;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public function render()
    {
        // Financial Stats
        $totalEarnings = User::where('payment_status', 'paid')->sum('total_price');
        $pendingAmount = User::whereIn('payment_status', ['unpaid', 'pending'])->sum('total_price');

        // Member Stats
        $activeMembers = User::where('application_status', 'approved')->count();
        $pendingApprovals = User::where('application_status', 'pending')->count();

        // Chart Data: Last 6 Months Revenue vs Pending
        $monthlyStats = User::select(
            // Use Y-m for sorting and grouping so months stay in order
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month_key"),
            DB::raw("DATE_FORMAT(created_at, '%b') as month"),
            DB::raw("SUM(CASE WHEN payment_status = 'paid' THEN total_price ELSE 0 END) as paid"),
            DB::raw("SUM(CASE WHEN payment_status != 'paid' THEN total_price ELSE 0 END) as pending")
        )
            ->where('created_at', '>=', now()->subMonths(6)->startOfMonth())
            ->groupBy('month_key', 'month') // Group by both
            ->orderBy('month_key', 'ASC')   // Order by the Y-m key
            ->get();

        return view('livewire.admin.home.index', [
            'totalEarnings' => $totalEarnings,
            'pendingAmount' => $pendingAmount,
            'activeMembers' => $activeMembers,
            'pendingApprovals' => $pendingApprovals,
            'recentUsers' => User::with('pricingPlan')->latest()->take(8)->get(),
            'chartMonths' => $monthlyStats->pluck('month')->toArray(),
            'chartPaid' => $monthlyStats->pluck('paid')->toArray(),
            'chartPending' => $monthlyStats->pluck('pending')->toArray(),
            'topHospitals' => Hospital::withCount('doctors')->orderBy('doctors_count', 'desc')->take(5)->get(),
        ]);
    }
}
