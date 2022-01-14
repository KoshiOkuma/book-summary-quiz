<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $books = Book::all();

        return view('books.index', compact(['books']));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        // if(request('image')){
        //     $filename = $request->image->getClientOriginalName();
        // }
            $filename = $request->image;

        Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'author' => $request->author,
            'image' => !empty($filename) ? Storage::putFile('public/images', $filename) : '',
            // 'image' => $request->file('image')->storeAs('public/images', $filename),
            ]);


        return redirect()->route('index');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        $summaries = Book::find($id)->summary;
        
        return view('books.show', compact(['book', 'summaries']));
    }
}
