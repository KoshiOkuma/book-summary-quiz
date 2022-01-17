<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Summary;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function create($id)
    {
        return view('summary.create', compact('id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required'],
        ]);

        Summary::create([
            'book_id' => $request->book_id,
            'content' => $request->content,
        ]);

        return redirect()->route('index');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('summary.edit', compact(['book', 'id']));
    }

    public function update(Request $request)
    {

        $request->validate([
            'content' => ['required', 'string'],
        ]);

        Summary::where('book_id', '=', $request->book_id)
        ->update([
            'content' => $request->content,
        ]);

        return redirect()->route('index');
    }
}
