<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(Request $request): View
    {
        // Only fetch the authenticated user's books, newest first.
        $books = Book::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('dashboard', compact('books'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'author' => ['required', 'string', 'max:100'],
            'pages' => ['required', 'integer', 'between:1,10000'],
        ]);

        // Never trust a user_id supplied by the form; use the signed-in user.
        $validated['user_id'] = $request->user()->id;

        Book::create($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Book registered successfully.');
    }
}
