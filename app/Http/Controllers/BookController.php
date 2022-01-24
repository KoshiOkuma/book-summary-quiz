<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $books = Book::all();
        $notShowing = Book::onlyTrashed()->get();

        return view('books.index', compact(['books', 'notShowing']));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:50'],
            'author' => ['required', 'max:10'],
        ]);

            $imageFile = $request->image;
            if(!is_null($imageFile)){
                $fileName = uniqid(rand().'_');
                $extension = $imageFile->extension();
                $fileNameToStore = $fileName . '.' . $extension;
                $resizedImage = Image::make($imageFile)->resize(100, 160)->encode();

                Storage::put('public/images/' . $fileNameToStore, $resizedImage);
            }

        Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'author' => $request->author,
            'image' => !is_null($imageFile) ? 'public/images/' . $fileNameToStore : '',
            ]);


        return redirect()->route('index')
        ->with([
            'message' => "本の登録を実施しました",
            'status' => 'info'
        ]);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('books.edit', compact('book'));
    }

    public function update(Request $request)
    {

        $imageFile = $request->image;
        if(!is_null($imageFile)){
            $fileName = uniqid(rand().'_');
            $extension = $imageFile->extension();
            $fileNameToStore = $fileName . '.' . $extension;
            $resizedImage = Image::make($imageFile)->resize(100, 160)->encode();

            Storage::put('public/images/' . $fileNameToStore, $resizedImage);
        }

        Book::where('id', $request->book_id)
        ->update([
            'title' => $request->title,
            'author' => $request->author,
            'image' => !is_null($imageFile) ? 'public/images/' . $fileNameToStore : '',
        ]);

        return redirect()->route('show', ['id' => $request->book_id])
        ->with([
            'message' => "本の内容を更新しました",
            'status' => 'info'
        ]);
    }

    public function destroy($id)
    {
        Book::findOrFail($id)->delete();

        return redirect()->route('index')
        ->with([
            'message' => "本を非表示にしました",
            'status' => 'info'
        ]);
    }
}
