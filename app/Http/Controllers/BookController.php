<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::whereNull('deleted_at')->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'isbn' => 'nullable|string|max:20',
            'category' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('book-covers', 'public');
        }

        Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'publisher' => $validated['publisher'],
            'publication_year' => $validated['publication_year'],
            'isbn' => $validated['isbn'],
            'category' => $validated['category'],
            'stock' => $validated['stock'],
            'cover' => $coverPath,
            'created_by' => Auth::id() ?? 0,
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function show(Book $book)
    {
        if ($book->deleted_at) {
            abort(404);
        }
        $book->load('loans.student.user');
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        if ($book->deleted_at) {
            abort(404);
        }
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'isbn' => 'nullable|string|max:20',
            'category' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $coverPath = $book->cover;
        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $coverPath = $request->file('cover')->store('book-covers', 'public');
        }

        $book->update([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'publisher' => $validated['publisher'],
            'publication_year' => $validated['publication_year'],
            'isbn' => $validated['isbn'],
            'category' => $validated['category'],
            'stock' => $validated['stock'],
            'cover' => $coverPath,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        $book->update([
            'deleted_at' => now(),
            'deleted_by' => Auth::id(),
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}