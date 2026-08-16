<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalBuyers = User::where('role', 'buyer')->count();

        $totalSellers = User::where('role', 'seller')->count();

        $activeSellers = User::where('role', 'seller')
            ->where('status', 'active')
            ->count();

        $inactiveSellers = User::where('role', 'seller')
            ->where('status', 'inactive')
            ->count();

        return view('admin.dashboard', compact(
            'totalBuyers',
            'totalSellers',
            'activeSellers',
            'inactiveSellers'
        ));
    }
}
