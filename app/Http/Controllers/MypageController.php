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
        $imageFile = $request->avator;
        if(!is_null($imageFile)){
            $fileName = uniqid(rand().'_');
            $extension = $imageFile->extension();
            $fileNameToStore = $fileName . '.' . $extension;
            // $originalName = $request->image->getClientOriginalName();
            $resizedImage = Image::make($imageFile)->resize(100, 100)->encode();

            Storage::put('public/images/' . $fileNameToStore, $resizedImage);
        }

        User::where('id', Auth::id())
        ->update([
            'avator' => !is_null($imageFile) ? 'public/images/' . $fileNameToStore : '',
        ]);

        return redirect()->route('mypage.index')
        ->with([
            'message' => "画像登録を実施しました",
            'status' => 'info'
        ]);
    }
    
}
