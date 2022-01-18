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

        return view('books.index', compact(['books']));
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

        // if(request('image')){
        //     $filename = $request->image->getClientOriginalName();
        // }
            $imageFile = $request->image;
            if(!is_null($imageFile)){
                $fileName = uniqid(rand().'_');
                $extension = $imageFile->extension();
                $fileNameToStore = $fileName . '.' . $extension;
                // $originalName = $request->image->getClientOriginalName();
                $resizedImage = Image::make($imageFile)->resize(100, 160)->encode();

                Storage::put('public/images/' . $fileNameToStore, $resizedImage);
            }

        Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'author' => $request->author,
            // 'image' => !empty($imageFile) ? Storage::putFile('public/images', $imageFile) : '',
            'image' => !is_null($imageFile) ? 'public/images/' . $fileNameToStore : '',
            // 'image' => $request->file('image')->storeAs('public/images', $filename),
            ]);


        return redirect()->route('index');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('books.show', compact('book'));
    }
    public function destroy($id)
    {
        
    }
}
