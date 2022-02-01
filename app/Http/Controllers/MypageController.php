<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MypageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $notShowing = Book::onlyTrashed()
        ->where('user_id', Auth::id())->get();
        $myBooks = Book::where('user_id', Auth::id())->get();

        return view('mypage.index', compact(['user', 'notShowing','myBooks']));
    }

    public function store(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $imageFile = $request->avator;
        if(!is_null($imageFile)){
            $fileName = uniqid(rand().'_');
            $extension = $imageFile->extension();
            $fileNameToStore = $fileName . '.' . $extension;
            $resizedImage = Image::make($imageFile)->resize(100, 100)->encode();

            Storage::put('public/images/' . $fileNameToStore, $resizedImage);
        }

        User::where('id', Auth::id())
        ->update([
            'avator' => !is_null($imageFile) ? 'public/images/' . $fileNameToStore : $user->avator,
        ]);

        return redirect()->route('mypage.index')
        ->with([
            'message' => "画像登録を実施しました",
            'status' => 'info'
        ]);
    }

    public function edit()
    {
        $user = User::findOrFail(Auth::id());

        return view('mypage.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::findOrFail(Auth::id());

        // $imageFile = $request->avator;
        // if(!is_null($imageFile)){
        //     $fileName = uniqid(rand().'_');
        //     $extension = $imageFile->extension();
        //     $fileNameToStore = $fileName . '.' . $extension;
        //     $resizedImage = Image::make($imageFile)->resize(1000, 1000)->encode();

        //     Storage::put('public/images/' . $fileNameToStore, $resizedImage);
        // }

        $filename = $request->avator;

        User::where('id', Auth::id())
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            // 'avator' => !is_null($imageFile) ? 'public/images/' . $fileNameToStore : $user->avator,
            'avator' => !is_null($filename) ? Storage::putFile('public/images', $filename) : $user->avator,
        ]);

        return redirect()->route('mypage.index')
        ->with([
            'message' => "プロフィールを更新しました",
            'status' => 'info'
        ]);
    }

    public function restore($id)
    {
        Book::onlyTrashed()
        ->where('id',$id)->restore();

        return redirect()->route('mypage.index')
        ->with([
            'message' => "本を再表示しました",
            'status' => 'info'
        ]);

    }

    public function forceDestroy($id)
    {
        Book::onlyTrashed()
        ->where('id',$id)->forceDelete();

        return redirect()->route('mypage.index')
        ->with([
            'message' => "本を完全に削除しました",
            'status' => 'info'
        ]);
    }

}
