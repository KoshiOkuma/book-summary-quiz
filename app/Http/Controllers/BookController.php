<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $books = Book::select('*')->Paginate(14);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function createByAPI(Request $request)
    {
        $data = [];

        $items = null;

        if (!empty($request->keyword))
        {
            // 検索キーワードあり

            // 日本語で検索するためにURLエンコードする
            $title = urlencode($request->keyword);

            // APIを発行するURLを生成
            $url = 'https://www.googleapis.com/books/v1/volumes?q=' . $title . '&country=JP&tbm=bks';

            $client = new Client();

            // GETでリクエスト実行
            $response = $client->request("GET", $url);

            $body = $response->getBody();

            // レスポンスのJSON形式を連想配列に変換
            $bodyArray = json_decode($body, true);

            // 書籍情報部分を取得
            $items = $bodyArray['items'];

            // レスポンスの中身を見る
            // dd($items);
        }

        $data = [
            'items' => $items,
            'keyword' => $request->keyword,
        ];

        return view('books.createByAPI', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'author' => ['required', 'string', 'max:50'],
            'image' => ['image', 'mimes:jpg, jpeg, png', 'max:2048'],
        ]);

            $imageFile = $request->image;
            if(!is_null($imageFile)){
                $fileName = uniqid(rand().'_');
                $extension = $imageFile->extension();
                $fileNameToStore = $fileName . '.' . $extension;
                $resizedImage = Image::make($imageFile)->resize(724, 1024)->encode();

                Storage::put('public/images/' . $fileNameToStore, $resizedImage);
            }

        Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'author' => $request->author,
            'image' => !is_null($imageFile) ? 'public/images/' . $fileNameToStore : 'public/images/no_image.jpg',
            ]);


        return redirect()->route('index')
        ->with([
            'message' => "本の登録を実施しました",
            'status' => 'info'
        ]);
    }

    public function storeByAPI(Request $request)
    {
        dd($request);
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
        $request->validate([
            'title' => ['required', 'string', 'max:50'],
            'author' => ['required', 'string', 'max:50'],
            'image' => ['image', 'mimes:jpg, jpeg, png', 'max:2048'],
        ]);

        $book = Book::FindOrFail($request->book_id);
        $imageFile = $request->image;
        if(!is_null($imageFile)){
            $fileName = uniqid(rand().'_');
            $extension = $imageFile->extension();
            $fileNameToStore = $fileName . '.' . $extension;
            $resizedImage = Image::make($imageFile)->resize(724, 1024)->encode();

            Storage::put('public/images/' . $fileNameToStore, $resizedImage);
        }

        Book::where('id', $request->book_id)
        ->update([
            'title' => $request->title,
            'author' => $request->author,
            'image' => !is_null($imageFile) ? 'public/images/' . $fileNameToStore : $book->image,
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

        return redirect()->route('mypage.index')
        ->with([
            'message' => "本を非表示にしました",
            'status' => 'info'
        ]);
    }

    public function showOtherUser($id)
    {
        $user = User::findOrFail($id);

        return view('books.showOtherUser', compact('user'));
    }
}
