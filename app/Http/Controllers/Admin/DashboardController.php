<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ActivityLog;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $totalBuyers = User::where('role', 'buyer')->count();

        $totalSellers = User::where('role', 'seller')->count();

        $activeSellers = User::where('role', 'seller')->where('status', 'active')->count();

        $inactiveSellers = User::where('role', 'seller')->where('status', 'inactive')->count();
        $recentActivities = ActivityLog::query()->with('user.sellerProfile')->latest()->take(8)->get();
        /*
|--------------------------------------------------------------------------
| Filter Chart
|--------------------------------------------------------------------------
*/

        $chartPeriod = $request->query('period', 'month');

        $currentYear = now()->year;

        $selectedMonth = now()->format('Y-m');

        $selectedYear = $currentYear;

        /*
|--------------------------------------------------------------------------
| Daftar Tahun
|--------------------------------------------------------------------------
*/

        $firstUserYear = User::query()
            ->whereIn('role', ['buyer', 'seller'])
            ->min('created_at');

        $startYear = $firstUserYear ? Carbon::parse($firstUserYear)->year : $currentYear;

        $availableYears = collect(range($currentYear, $startYear));

        /*
|--------------------------------------------------------------------------
| Chart Bulanan
|--------------------------------------------------------------------------
*/

        if ($chartPeriod === 'month') {
            $selectedMonth = $request->query('month', now()->format('Y-m'));

            try {
                $monthDate = Carbon::createFromFormat('Y-m', $selectedMonth)->startOfMonth();
            } catch (\Throwable $e) {
                $monthDate = now()->startOfMonth();

                $selectedMonth = $monthDate->format('Y-m');
            }

            $startDate = $monthDate->copy()->startOfMonth();

            $endDate = $monthDate->copy()->endOfMonth();

            /*
    |--------------------------------------------------------------------------
    | Ambil User Baru Per Hari
    |--------------------------------------------------------------------------
    */

            $userGrowth = User::query()
                ->whereIn('role', ['buyer', 'seller'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->groupByRaw('DATE(created_at)')
                ->pluck('total', 'date');

            /*
    |--------------------------------------------------------------------------
    | Isi Tanggal yang Tidak Ada User dengan 0
    |--------------------------------------------------------------------------
    */

            $chartLabels = [];

            $chartValues = [];

            for ($day = 1; $day <= $monthDate->daysInMonth; $day++) {
                $date = $monthDate->copy()->day($day);

                $dateKey = $date->format('Y-m-d');

                $chartLabels[] = $date->format('d');

                $chartValues[] = (int) ($userGrowth[$dateKey] ?? 0);
            }

            $chartTitle = 'Pertumbuhan Pengguna - ' . $monthDate->translatedFormat('F Y');
        } /*
|--------------------------------------------------------------------------
| Chart Tahunan
|--------------------------------------------------------------------------
*/ else {
            $selectedYear = (int) $request->query('year', $currentYear);

            if ($selectedYear < $startYear || $selectedYear > $currentYear) {
                $selectedYear = $currentYear;
            }

            $startDate = Carbon::create($selectedYear, 1, 1)->startOfYear();

            $endDate = $startDate->copy()->endOfYear();

            /*
    |--------------------------------------------------------------------------
    | User Baru Per Bulan
    |--------------------------------------------------------------------------
    */

            $userGrowth = User::query()
                ->whereIn('role', ['buyer', 'seller'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->groupByRaw('MONTH(created_at)')
                ->pluck('total', 'month');

            $chartLabels = [];

            $chartValues = [];

            for ($month = 1; $month <= 12; $month++) {
                $chartLabels[] = Carbon::create(null, $month, 1)->locale('id')->translatedFormat('M');

                $chartValues[] = (int) ($userGrowth[$month] ?? 0);
            }

            $chartTitle = 'Pertumbuhan Pengguna - ' . $selectedYear;
        }
        return view('admin.dashboard', compact('chartPeriod', 'selectedMonth', 'selectedYear', 'availableYears', 'chartLabels', 'chartValues', 'chartTitle', 'totalBuyers', 'totalSellers', 'activeSellers', 'inactiveSellers', 'recentActivities'));
    }
}
