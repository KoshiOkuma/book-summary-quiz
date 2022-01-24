<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class MypageController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view('mypage.index', compact('user'));
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
        User::where('id', Auth::id())
        ->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('mypage.index')
        ->with([
            'message' => "プロフィールを更新しました",
            'status' => 'info'
        ]);
    }

}
