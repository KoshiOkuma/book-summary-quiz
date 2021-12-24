<?php

namespace App\Http\Controllers;

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
        Summary::create([
            'book_id' => $request->book_id ,
            'content' => $request->content,
        ]);

        return redirect()->route('index');
    }
}
