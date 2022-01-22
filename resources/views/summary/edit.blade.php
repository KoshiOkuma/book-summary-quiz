<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<form action="{{ route('summary.update') }}" method="POST">
    @csrf
    <textarea name="content"cols="30" rows="10">{{$book->summary->content}}</textarea>
    <input type="hidden" name="book_id" value="{{$book->id}}">
    <input type="button" onclick="location.href='{{route('show', ['id' => $book->id])}}' " value="戻る">
    <input type="submit" value="更新">
</form>

<form id="delete_{{ $book->summary->id }}" action="{{ route('summary.destroy',['id' => $book->summary->id] )}}" method="post">
    @csrf
    <input type="hidden" name="book_id" value="{{$book->id}}">
    <a href="#" data-id="{{ $book->summary->id }}" onclick="deleteBook(this)">削除</a>
</form>

<script>
    function deleteBook(e) {
        'use strict'
        if(confirm('本当に削除しますか？')){
            document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
</script>

</x-app-layout>
