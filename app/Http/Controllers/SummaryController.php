<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Summary;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($id)
    {
        return view('summary.create', compact('id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string'],
        ]);

        Summary::create([
            'book_id' => $request->book_id,
            'content' => $request->content,
        ]);

        return redirect()->route('show', ['id' => $request->book_id])
        ->with([
            'message' => "要約を作成しました",
            'status' => 'info'
        ]);
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('summary.edit', compact('book'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'content' => ['required', 'string'],
        ]);

        Summary::where('book_id', $request->book_id)
        ->update([
            'content' => $request->content,
        ]);

        return redirect()->route('show', ['id' => $request->book_id])
        ->with([
            'message' => "要約を更新しました",
            'status' => 'info'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        Summary::findOrFail($id)->delete();

        return redirect()->route('show', ['id' => $request->book_id])
        ->with([
            'message' => "要約を削除しました",
            'status' => 'info'
        ]);
    }
}
