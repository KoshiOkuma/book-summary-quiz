<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div>問題：{{$question->content}}</div>
    <div>正解です！</div>
    <div>
        @foreach ($choices as $choice )
        <div>{{$choice}}</div>
        @endforeach
    </div>
    <div>{{$question->description}}</div>
    <input type="button" onclick="location.href='{{route('show', ['id' => $question->book_id])}}' " value="戻る">


</x-app-layout>
