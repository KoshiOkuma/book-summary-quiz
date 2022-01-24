<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-flash-message status="session('status')" />

    @foreach ($books as $book )
    title: <a href="{{route('show', ['id' => $book->id])}}">{{$book->title}}</a>
    <br>
    @endforeach

    <input type="button" onclick="location.href='{{route('create')}}' " value="新規作成">
   

</x-app-layout>
