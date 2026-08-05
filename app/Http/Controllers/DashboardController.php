<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DepositTransaction;
use App\Models\WithdrawalTransaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        // Summary statistics
        $totalCustomers = Customer::count();

        $activeCustomers = Customer::whereHas('depositTransactions')
            ->orWhereHas('withdrawalTransactions')
            ->count();

        // Sum the total_amount column (migration uses amount)
        $totalSavingsBalance = Customer::sum('balance');

        // Recent transactions (last 5)
        $latestDeposits = DepositTransaction::with('customer')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $latestWithdrawals = WithdrawalTransaction::with('customer')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalCustomers',
            'activeCustomers',
            'totalSavingsBalance',
            'latestDeposits',
            'latestWithdrawals'
        ));
    }
}
