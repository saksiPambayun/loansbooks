<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Student;
use App\Models\Book;
use App\Models\LoanStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['student.user', 'book', 'latestStatus'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.loans.index', compact('loans'));
    }

    public function studentIndex()
    {
        $student = Auth::user()->student;
        if (!$student) {
            return redirect()->route('dashboard')->with('error', 'Profil siswa tidak ditemukan');
        }

        $loans = Loan::with(['book', 'latestStatus'])
            ->where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('student.loans.index', compact('loans'));
    }

    public function create()
    {
        $students = Student::with('user')
            ->whereNull('deleted_at')
            ->get();
        $books = Book::whereNull('deleted_at')
            ->where('stock', '>', 0)
            ->get();
        return view('admin.loans.create', compact('students', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        DB::beginTransaction();
        try {
            $book = Book::find($validated['book_id']);
            if ($book->stock <= 0) {
                return back()->withInput()->with('error', 'Stok buku tidak tersedia');
            }

            $loan = Loan::create([
                'student_id' => $validated['student_id'],
                'book_id' => $validated['book_id'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'created_by' => Auth::id() ?? 0,
            ]);

            LoanStatus::create([
                'loan_id' => $loan->id,
                'status' => 'pending',
            ]);

            $book->decrement('stock');

            DB::commit();
            return redirect()->route('admin.loans.index')
                ->with('success', 'Peminjaman berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal membuat peminjaman: ' . $e->getMessage());
        }
    }

    public function studentStore(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'duration' => 'required|integer|min:1|max:14', // Max 14 hari
        ]);

        $student = Auth::user()->student;
        if (!$student) {
            return back()->with('error', 'Profil siswa tidak ditemukan');
        }

        DB::beginTransaction();
        try {
            $book = Book::find($validated['book_id']);
            if ($book->stock <= 0) {
                return back()->with('error', 'Stok buku tidak tersedia');
            }

            $start_date = Carbon::today();
            $end_date = Carbon::today()->addDays($validated['duration']);

            $loan = Loan::create([
                'student_id' => $student->id,
                'book_id' => $validated['book_id'],
                'start_date' => $start_date,
                'end_date' => $end_date,
                'created_by' => Auth::id(),
            ]);

            LoanStatus::create([
                'loan_id' => $loan->id,
                'status' => 'pending',
            ]);

            // Stok tidak langsung dikurangi saat request? 
            // Biasanya dikurangi saat disetujui (approved) atau saat request (pending).
            // Berdasarkan store() admin tadi, stok dikurangi saat request. Kita ikuti saja.
            $book->decrement('stock');

            DB::commit();
            return redirect()->route('student.loans.index')
                ->with('success', 'Permintaan peminjaman berhasil diajukan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengajukan peminjaman: ' . $e->getMessage());
        }
    }

    public function show(Loan $loan)
    {
        $loan->load(['student.user', 'book', 'statuses']);
        return view('admin.loans.show', compact('loan'));
    }

    public function approve($id)
    {
        $loan = Loan::findOrFail($id);

        DB::beginTransaction();
        try {
            LoanStatus::create([
                'loan_id' => $loan->id,
                'status' => 'approved',
            ]);

            DB::commit();
            return redirect()->route('admin.loans.show', $loan)
                ->with('success', 'Peminjaman berhasil disetujui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyetujui peminjaman: ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        $loan = Loan::findOrFail($id);

        DB::beginTransaction();
        try {
            LoanStatus::create([
                'loan_id' => $loan->id,
                'status' => 'rejected',
            ]);

            // Kembalikan stok buku
            $loan->book->increment('stock');

            DB::commit();
            return redirect()->route('admin.loans.show', $loan)
                ->with('success', 'Peminjaman berhasil ditolak');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menolak peminjaman: ' . $e->getMessage());
        }
    }

    public function return($id)
    {
        $loan = Loan::findOrFail($id);

        DB::beginTransaction();
        try {
            // Cek apakah terlambat
            $today = Carbon::today();
            $endDate = Carbon::parse($loan->end_date);
            $status = $today->greaterThan($endDate) ? 'late' : 'returned';

            LoanStatus::create([
                'loan_id' => $loan->id,
                'status' => $status,
            ]);

            // Kembalikan stok buku
            $loan->book->increment('stock');

            DB::commit();
            return redirect()->route('admin.loans.show', $loan)
                ->with('success', 'Buku berhasil dikembalikan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengembalikan buku: ' . $e->getMessage());
        }
    }

    public function checkOverdue()
    {
        $today = Carbon::today();

        $overdueLoans = Loan::whereHas('latestStatus', function ($query) {
            $query->where('status', 'approved');
        })
            ->where('end_date', '<', $today)
            ->with(['student.user', 'book'])
            ->get();

        return view('admin.loans.overdue', compact('overdueLoans'));
    }
}