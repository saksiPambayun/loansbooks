<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Dashboard;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  
    public function adminDashboard()
    {
     $loanPerMonth = Loan::select(
        DB::raw('MONTH(start_date) as month'),
        DB::raw('COUNT(*) as total')
    )
    ->whereYear('start_date', now()->year)
    ->groupBy(DB::raw('MONTH(start_date)'))
    ->orderBy('month')
    ->pluck('total', 'month');


        $loanChartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $loanChartData[] = $loanPerMonth[$i] ?? 0;
        }

        return view('admin.dashboard', [
            'totalBooks' => Book::count(),
            'totalStudents' => User::where('access_type', 'Student')->count(),

            'activeLoans' => Loan::whereHas(
                'latestStatus',
                fn ($q) => $q->where('status', 'approved')
            )->count(),

            'pendingLoans' => Loan::whereHas(
                'latestStatus',
                fn ($q) => $q->where('status', 'pending')
            )->count(),

            'overdueLoans' => Loan::whereHas(
                'latestStatus',
                fn ($q) => $q->where('status', 'late')
            )->count(),

            'latestLoans' => Loan::with(['student', 'book', 'latestStatus'])
                ->latest('created_at')
                ->limit(5)
                ->get(),

            'loanChartData' => $loanChartData,
        ]);
    }

   public function studentDashboard()
{
    $user = Auth::user();

    // === CHART: peminjaman siswa per bulan (tahun berjalan)
    $loanPerMonth = Loan::whereHas('student', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
        ->select(
            DB::raw('MONTH(start_date) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('start_date', now()->year)
        ->groupBy(DB::raw('MONTH(start_date)'))
        ->orderBy('month')
        ->pluck('total', 'month');

    $loanChartData = [];
    for ($i = 1; $i <= 12; $i++) {
        $loanChartData[] = $loanPerMonth[$i] ?? 0;
    }

    return view('student.dashboard', [
        'totalBooks' => Book::where('stock', '>', 0)->count(),

        'activeLoans' => Loan::whereHas('student', fn ($q) =>
            $q->where('user_id', $user->id)
        )->whereHas('latestStatus', fn ($q) =>
            $q->whereIn('status', ['approved', 'borrowed'])
        )->count(),

        'pendingLoans' => Loan::whereHas('student', fn ($q) =>
            $q->where('user_id', $user->id)
        )->whereHas('latestStatus', fn ($q) =>
            $q->where('status', 'pending')
        )->count(),

        'overdueLoans' => Loan::whereHas('student', fn ($q) =>
            $q->where('user_id', $user->id)
        )->whereHas('latestStatus', fn ($q) =>
            $q->where('status', 'late')
        )->count(),

        'loanChartData' => $loanChartData,
    ]);
}


}
