<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            マイページ
        </h2>
    </x-slot>
    <x-flash-message status="session('status')" />
    {{-- <form action="{{ route('mypage.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="avator">画像</label>
        <input type="file" name="avator" id="avatar" accept="image/png,image/jpeg,image/jpg">
        <input type="submit" value="画像登録">
    </form> --}}
    {{-- <img src="{{ Storage::url($user->avator)}}"> --}}
    <div>{{$user->name}}</div>
    <div>{{$user->email}}</div>
    <input type="button" onclick="location.href='{{route('mypage.edit')}}' " value="プロフィール編集">
    <div>My Books</div>
    @foreach ($myBooks as$myBook )
    <div>title: <a href="{{route('show', ['id' => $myBook->id])}}">{{$myBook['title']}}</a></div>
    @endforeach
    <div>非表示リスト</div>
    @foreach ($notShowing as $notShow )
    <div>{{$notShow->title}}</div>
    <form id="restore_{{ $notShow->id }}" action="{{ route('mypage.restore',['id' => $notShow->id] )}}" method="post">
        @csrf
        <a href="#" data-id="{{ $notShow->id }}" onclick="restoreBook(this)">公開する</a>
    </form>
    <form id="delete_{{ $notShow->id }}" action="{{ route('mypage.forceDestroy',['id' => $notShow->id] )}}" method="post">
        @csrf
        <a href="#" data-id="{{ $notShow->id }}" onclick="forceDeleteBook(this)">完全に削除する</a>
    </form>
    @endforeach

    <div class="flex items-center justify-center">
        <div class="bg-white font-semibold text-center rounded-3xl border shadow-lg p-10 max-w-xs">
            <form action="{{ route('mypage.update') }}" method="POST" enctype="multipart/form-data" class="mt-2">
                @csrf
                {{-- <div class="text-sm text-gray-900"> --}}
                <input type="file" name="avator" id="avatar" accept="image/png,image/jpeg,image/jpg">
                {{-- </div> --}}
                <img class="mb-3 w-32 h-32 rounded-full shadow-lg mx-auto" src="{{ Storage::url($user->avator)}}">
                {{-- <h1 class="text-lg text-gray-700">{{$user->name}}</h1>
                <h1 class="text-lg text-gray-700">{{$user->email}}</h1> --}}
                <label for="answer">名前</label>
                <input type="text" name="name" value="{{$user->name}}">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{$user->email}}">
                <input type="submit" value="プロフィール更新">
                </form>
        </div>
    </div>

    <script>
        function restoreBook(e) {
            'use strict'
            if(confirm('本当に公開しますか？')){
                document.getElementById('restore_' + e.dataset.id).submit();
            }
        }

        function forceDeleteBook(e) {
            'use strict'
            if(confirm('完全に削除しますか？この動作は元に戻すことができません。')){
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
