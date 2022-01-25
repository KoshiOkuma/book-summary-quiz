<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            本一覧
        </h2>
    </x-slot>
    <x-flash-message status="session('status')" />
    <div>
        <input type="button" onclick="location.href='{{route('mypage.index')}}' " value="Mypage">
    </div>
    <div>
        <input type="button" onclick="location.href='{{route('question.index')}}' " value="クイズ一覧">
    </div>
    @foreach ($books as $book )
    title: <a href="{{route('show', ['id' => $book->id])}}">{{$book->title}}</a>
    <br>
    @endforeach

    <input type="button" onclick="location.href='{{route('create')}}' " value="新規作成">


</x-app-layout>
