<?php

namespace App\Livewire\Admin\Home;

use Livewire\Component;
use App\Models\User;
use App\Models\Hospital;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public function render()
    {
        // Base query to target only users with the 'member' role
        $memberQuery = User::whereHas('role', function ($query) {
            $query->where('slug', 'member');
        });

        // Financial Stats (Members Only)
        $totalEarnings = (clone $memberQuery)->where('payment_status', 'paid')->sum('total_price');

        $pendingAmount = (clone $memberQuery)->whereIn('payment_status', ['unpaid', 'pending'])
            ->sum('total_price');

        // Membership Stats (Members Only)
        $activeMembers = (clone $memberQuery)->where('application_status', 'approved')->count();

        $pendingApprovals = (clone $memberQuery)->where('application_status', 'pending')->count();

        // Chart Data: Last 6 Months Revenue vs Pending (Members Only)
        $monthlyStats = (clone $memberQuery)->select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month_key"),
            DB::raw("DATE_FORMAT(created_at, '%b') as month"),
            DB::raw("SUM(CASE WHEN payment_status = 'paid' THEN total_price ELSE 0 END) as paid"),
            DB::raw("SUM(CASE WHEN payment_status != 'paid' THEN total_price ELSE 0 END) as pending")
        )
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('month_key', 'month')
            ->orderBy('month_key', 'ASC')
            ->get();

        return view('livewire.admin.home.index', [
            'totalEarnings' => $totalEarnings,
            'pendingAmount' => $pendingAmount,
            'activeMembers' => $activeMembers,
            'pendingApprovals' => $pendingApprovals,
            // Only show recent 'Members'
            'recentUsers' => (clone $memberQuery)->with('pricingPlan')->latest()->take(8)->get(),
            'chartMonths' => $monthlyStats->pluck('month')->toArray(),
            'chartPaid' => $monthlyStats->pluck('paid')->toArray(),
            'chartPending' => $monthlyStats->pluck('pending')->toArray(),
            // Hospitals are providers, so they remain unfiltered by 'member' role
            'topHospitals' => Hospital::withCount('doctors')->orderBy('doctors_count', 'desc')->take(5)->get(),
        ]);
    }
}
