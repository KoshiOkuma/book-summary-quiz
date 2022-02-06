<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:255'],
            'wrong_answer1' => ['required', 'string', 'max:255'],
            'wrong_answer2' => ['required', 'string', 'max:255'],
            'description' => ['max:500'],
        ]);

        try{
            DB::transaction(function () use($request){
                Question::create([
                    'book_id' => $request->book_id,
                    'content' => $request->question,
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
                },2);
            }catch(Throwable $e){
                Log::error($e);
                throw $e;
             }

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
        $answer = $choices[0];

        return [$question, $choices, $answer];
    }

    public function show($id)
    {
        list($question, $choices, $answer) = $this->showBase($id);
        shuffle($choices);

        return view('questions.show', compact(['question', 'choices', 'answer']));
    }
    public function answer($id)
    {
        list($question, $choices) = $this->showBase($id);
        $answer = $choices[0];

        return view('questions.answer', compact(['question', 'answer']));
    }

    public function wrong_answer($id)
    {
        list($question, $choices) = $this->showBase($id);
        $answer = $choices[0];

        return view('questions.wrong_answer', compact(['question', 'answer']));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);

        return view('questions.edit', compact('question'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:255'],
            'wrong_answer1' => ['required', 'string', 'max:255'],
            'wrong_answer2' => ['required', 'string', 'max:255'],
            'description' => ['max:500'],
        ]);

        try{
            DB::transaction(function () use($request) {
                Question::where('id', $request->question_id)
                ->update([
                    'content' => $request->question,
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
                },2);
            }catch(Throwable $e){
                Log::error($e);
                throw $e;
            }


        return redirect()->route('show', ['id' => $request->book_id])
        ->with([
            'message' => "問題を更新しました",
            'status' => 'info'
        ]);
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        Choice::where('question_id', $id)->delete();
        $question->delete();

        return redirect()->route('show', ['id' => $question->book_id])
        ->with([
            'message' => "問題を削除しました",
            'status' => 'info'
        ]);
    }



}
