<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            クイズ編集
        </h2>
    </x-slot>

<form action="{{ route('question.update') }}" method="POST">
    @csrf
    <label for="content">問題文</label>
    <input type="text" name="content" value="{{$question->content}}">
    <label for="answer">答え</label>
    <input type="text" name="answer" value="{{$question->choice[0]->content}}">
    <label for="fail1">誤答1</label>
    <input type="text" name="wrong_answer1" value="{{$question->choice[1]->content}}">
    <label for="fail2">誤答2</label>
    <input type="text" name="wrong_answer2" value="{{$question->choice[2]->content}}">
    <label for="description">解説</label>
    <input type="text" name="description" value="{{$question->description}}">
    <input type="hidden" name="book_id" value="{{$question->book_id}}">
    <input type="hidden" name="id" value="{{$question->id}}">
    <input type="hidden" name="choices[0]" value="{{$question->choice[0]->id}}">
    <input type="hidden" name="choices[1]" value="{{$question->choice[1]->id}}">
    <input type="hidden" name="choices[2]" value="{{$question->choice[2]->id}}">
    <input type="button" onclick="location.href='{{route('show', ['id' => $question->book_id ])}}' " value="戻る">
    <input type="submit" value="更新">
</form>

<form id="delete_{{ $question->id }}" action="{{ route('question.destroy',['id' => $question->id] )}}" method="post">
    @csrf
    <input type="hidden" name="book_id" value="{{$question->book_id}}">
    <a href="#" data-id="{{ $question->id }}" onclick="deleteBook(this)">削除</a>
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
