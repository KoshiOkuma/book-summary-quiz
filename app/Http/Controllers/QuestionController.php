<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create($id)
    {
        return view('questions.create', compact('id'));
    }

    public function store(Request $request)
    {
        Question::create([
            'book_id' => $request->book_id,
            'content' => $request->content,
            'description' => $request->description,
        ]);

        $question_id = Question::latest()->get();

        Choice::create([
            'question_id' => $question_id[0]['id'],
            'content' => $request->answer,
            'is_answer' => 1,
        ]);

        Choice::create([
            'question_id' =>$question_id[0]['id'],
            'content' => $request->fail1,
            'is_answer' => 0,
        ]);

        Choice::create([
            'question_id' =>$question_id[0]['id'],
            'content' => $request->fail2,
            'is_answer' => 0,
        ]);

        return redirect()->route('show', ['id' => $request->book_id])
        ->with([
            'message' => "問題を作成しました",
            'status' => 'info'
        ]);
    }
}
