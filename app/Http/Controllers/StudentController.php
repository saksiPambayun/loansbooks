<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'classroom'])->paginate(10); // SoftDeletes otomatis exclude yang terhapus
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classrooms = Classroom::whereNull('deleted_at')->get();
        return view('admin.students.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'classroom_id' => 'required|exists:classrooms,id',
            'nisn' => 'required|numeric|unique:students,nisn',
        ]);

        DB::beginTransaction();
        try {
            // Buat user terlebih dahulu
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'access_type' => 2, // Siswa
                'created_by' => Auth::id() ?? 0,
            ]);

            // Kemudian buat student
            Student::create([
                'user_id' => $user->id,
                'classroom_id' => $validated['classroom_id'],
                'nisn' => $validated['nisn'],
                'created_by' => Auth::id() ?? 0,
            ]);

            DB::commit();
            return redirect()->route('admin.students.index')
                ->with('success', 'Siswa berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal menambahkan siswa: ' . $e->getMessage());
        }
    }

    public function show(Student $student)
    {
        if ($student->deleted_at) {
            abort(404);
        }
        $student->load(['user', 'classroom', 'loans.book']);
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        if ($student->deleted_at) {
            abort(404);
        }
        $classrooms = Classroom::whereNull('deleted_at')->get();
        $student->load('user');
        return view('admin.students.edit', compact('student', 'classrooms'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'password' => 'nullable|string|min:8|confirmed',
            'classroom_id' => 'required|exists:classrooms,id',
            'nisn' => 'required|numeric|unique:students,nisn,' . $student->id,
        ]);

        DB::beginTransaction();
        try {
            // Update user
            $student->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'updated_by' => Auth::id(),
            ]);

            if (!empty($validated['password'])) {
                $student->user->update(['password' => Hash::make($validated['password'])]);
            }

            // Update student
            $student->update([
                'classroom_id' => $validated['classroom_id'],
                'nisn' => $validated['nisn'],
                'updated_by' => Auth::id(),
            ]);

            DB::commit();
            return redirect()->route('admin.students.index')
                ->with('success', 'Siswa berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal mengupdate siswa: ' . $e->getMessage());
        }
    }

    public function destroy(Student $student)
    {
        DB::beginTransaction();
        try {
            $student->deleted_by = Auth::id();
            $student->save();
            $student->delete();

            $student->user->deleted_by = Auth::id();
            $student->user->save();
            $student->user->delete();

            DB::commit();
            return redirect()->route('admin.students.index')
                ->with('success', 'Siswa berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus siswa: ' . $e->getMessage());
        }
    }
}