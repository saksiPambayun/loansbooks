<?php

namespace App\Http\Controllers;

use App\Models\LoanStatus;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanStatusesController extends Controller
{
    public function index($loanId)
    {
        $loan = Loan::with(['student.user', 'book'])->findOrFail($loanId);
        $statuses = LoanStatus::wheree('loan_id', $loanId)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('loan-statuses.index', compact('loan', 'statuses'));
    }

    public function show(LoanStatus $loanStatus)
    {
        $loanStatus->load('loan.student.user', 'loan.book');
        return view('loan-statuses.show', compact('loanStatus'));
    }
}