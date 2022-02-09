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

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'avatar' => ['image', 'mimes:jpg, jpeg, png', 'max:2048'],
        ]);

        $user = User::findOrFail(Auth::id());

        User::where('id', Auth::id())
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => !is_null($request->avatar) ? Storage::putFile('public/images', $request->avatar) : $user->avatar,
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
