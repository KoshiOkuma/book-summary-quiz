<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $questions = Question::all();

        return view('questions.index', compact('questions'));

    }

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

    public function showBase($id)
    {
        $question = Question::findOrFail($id);
        $choices = [];
        foreach($question->choice as $choice){
            array_push($choices, $choice['content']);
        }

        return [$question, $choices];
    }

    public function show($id)
    {
        list($question, $choices) = $this->showBase($id);
        $answer = $choices[0];
        shuffle($choices);

        return view('questions.show', compact(['question', 'choices', 'answer']));
    }
    public function answer($id)
    {
        list($question, $choices) = $this->showBase($id);

        return view('questions.answer', compact(['question', 'choices']));
    }

    public function wrong_answer($id)
    {
        list($question, $choices) = $this->showBase($id);

        return view('questions.wrong_answer', compact(['question', 'choices']));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);

        return view('questions.edit', compact('question'));
    }

    public function update(Request $request)
    {
        Question::where('id', $request->id)
        ->update([
            'content' => $request->content,
            'description' => $request->description,
        ]);

        Choice::where('id', $request->choices[0])
        ->update([
            'content' => $request->answer,
        ]);

        Choice::where('id', $request->choices[1])
        ->update([
            'content' => $request->wrong_answer1,
        ]);

        Choice::where('id', $request->choices[2])
        ->update([
            'content' => $request->wrong_answer2,
        ]);

        return redirect()->route('show', ['id' => $request->book_id])
        ->with([
            'message' => "問題を更新しました",
            'status' => 'info'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        Choice::where('question_id', $id)->delete();
        Question::findOrFail($id)->delete();

        return redirect()->route('show', ['id' => $request->book_id])
        ->with([
            'message' => "問題を削除しました",
            'status' => 'info'
        ]);
    }



}
