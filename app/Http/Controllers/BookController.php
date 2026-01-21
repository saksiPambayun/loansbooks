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
        $books = Book::paginate(10); // SoftDeletes otomatis exclude yang terhapus
        return view('admin.books.index', compact('books'));
    }

    public function katalog(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != 'Semua') {
            $query->where('category', $request->category);
        }

        $books = $query->paginate(12);
        return view('katalog', compact('books'));
    }

  public function studentIndex(Request $request)
{
    $query = Book::whereNull('deleted_at');

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('author', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('category') && $request->category !== 'Semua') {
        $query->where('category', $request->category);
    }

    $books = $query->paginate(12);

    return view('student.books.index', compact('books'));
}

public function studentShow($id)
{
    $book = Book::whereNull('deleted_at')->findOrFail($id);

    return view('student.books.detail', compact('book'));
}

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
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
            'category' => $validated['category'],
            'publication_year' => $validated['year'],
            'stock' => $validated['stock'],
            'cover' => $coverPath,
            'created_by' => Auth::id() ?? 0,
        ]);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function show(Book $book)
    {
        if ($book->deleted_at) {
            abort(404);
        }
        $book->load('loans.student.user');
        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        if ($book->deleted_at) {
            abort(404);
        }
        return view('admin.books.edit', compact('book'));
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

        $book->title = $validated['title'];
        $book->author = $validated['author'];
        $book->publisher = $validated['publisher'];
        $book->publication_year = $validated['publication_year'];
        $book->isbn = $validated['isbn'] ?? null;
        $book->category = $validated['category'];
        $book->stock = $validated['stock'];
        $book->cover = $coverPath;
        $book->updated_by = Auth::id();
        $book->save();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        $book->deleted_by = Auth::id();
        $book->save();
        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus');
    }
    // Menampilkan detail buku untuk katalog publik
    public function detail($id)
    {
        $book = Book::findOrFail($id); // SoftDeletes otomatis exclude yang terhapus
        return view('detail', compact('book'));
    }
}