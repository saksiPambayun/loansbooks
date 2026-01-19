<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::whereNull('deleted_at')->paginate(10);
        return view('admin.classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        return view('admin.classrooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_name' => 'required|string|max:255',
        ]);

        Classroom::create([
            'class_name' => $validated['class_name'],
            'created_by' => Auth::id() ?? 0,
        ]);

        return redirect()->route('admin.classrooms.index')
            ->with('success', 'Kelas berhasil ditambahkan');
    }

    public function show(Classroom $classroom)
    {
        if ($classroom->deleted_at) {
            abort(404);
        }
        $classroom->load('students.user');
        return view('admin.classrooms.show', compact('classroom'));
    }

    public function edit(Classroom $classroom)
    {
        if ($classroom->deleted_at) {
            abort(404);
        }
        return view('admin.classrooms.edit', compact('classroom'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $validated = $request->validate([
            'class_name' => 'required|string|max:255',
        ]);

        $classroom->update([
            'class_name' => $validated['class_name'],
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('classrooms.index')
            ->with('success', 'Kelas berhasil diupdate');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->update([
            'deleted_at' => now(),
            'deleted_by' => Auth::id(),
        ]);

        return redirect()->route('classrooms.index')
            ->with('success', 'Kelas berhasil dihapus');
    }
}