<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

        <form action="{{ route('questions.store') }}" method="POST">
            @csrf
            <label for="content">問題文</label>
            <input type="text" name="content">
            <label for="answer">答え</label>
            <input type="text" name="answer">
            <label for="fail1">誤答1</label>
            <input type="text" name="wrong_answer1">
            <label for="fail2">誤答2</label>
            <input type="text" name="wrong_answer2">
            <label for="description">解説</label>
            <input type="text" name="description">
            <input type="hidden" name="book_id" value="{{$id}}">
            <input type="button" onclick="location.href='{{route('show', ['id' => $id])}}' " value="戻る">
            <input type="submit" value="作成">
        </form>

</x-app-layout>
