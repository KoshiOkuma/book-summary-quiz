<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-flash-message status="session('status')" />
    <img src="{{ Storage::url($book->image)}}">
    <div>title::{{$book->title}}</div>
    <div>author::{{$book->author}}</div>
    @if ($book->summary)
    <div>summary::{{$book->summary->content}}</div>
    @endif
    <div>by {{$book->user->name}}</div>
    @if (is_null($book->summary))
    <input type="button" onclick="location.href='{{route('summary.create', ['id' => $book->id])}}' " value="要約の作成">
    @endif
    @if ($book->summary)
    <input type="button" onclick="location.href='{{route('summary.edit', ['id' => $book->id])}}' " value="要約の編集">
    @endif
    <input type="button" onclick="location.href='{{route('index')}}' " value="戻る">
    <form id="delete_{{ $book->id }}" action="{{ route('destroy',['id' => $book->id] )}}" method="post">
        @csrf
        <a href="#" data-id="{{ $book->id }}" onclick="deleteBook(this)">非公開にする</a>
    </form>

    <script>
        function deleteBook(e) {
            'use strict'
            if(confirm('本当に非公開にしますか？')){
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>

</x-app-layout>
