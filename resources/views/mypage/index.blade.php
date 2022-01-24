<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-flash-message status="session('status')" />
    <form action="{{ route('mypage.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="avator">画像</label>
        <input type="file" name="avator" id="avatar" accept="image/png,image/jpeg,image/jpg">
        <input type="submit" value="画像登録">
    </form>
    <img src="{{ Storage::url($user->avator)}}">
    <div>{{$user->name}}</div>
    <div>{{$user->email}}</div>

    <input type="button" onclick="location.href='{{route('mypage.edit')}}' " value="プロフィール編集">
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
