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
            'is_answer' => \Constant::ANSWER,
        ]);

        Choice::create([
            'question_id' =>$question_id[0]['id'],
            'content' => $request->wrong_answer1,
            'is_answer' => \Constant::NOT_ANSWER,
        ]);

        Choice::create([
            'question_id' =>$question_id[0]['id'],
            'content' => $request->wrong_answer2,
            'is_answer' => \Constant::NOT_ANSWER,
        ]);

        return redirect()->route('show', ['id' => $request->book_id])
        ->with([
            'message' => "問題を作成しました",
            'status' => 'info'
        ]);
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);

        $choices = [];
        foreach($question->choice as $choice){
            array_push($choices, $choice['content']);
        }
        $answer = $choices[0];
        shuffle($choices);


        return view('questions.show', compact(['question', 'choices', 'answer']));
    }

}
