<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div>問題：{{$question->content}}</div>
    <div>
        @foreach ($choices as $choice )
        <a href="@if ($choice === $answer)
        {{route('questions.answer', ['id' => $question->id])}}
        @else
        {{route('questions.wrong_answer', ['id' => $question->id])}}
        @endif">{{$choice}}</a>
        @endforeach
    </div>
    <input type="button" onclick="location.href='{{route('show', ['id' => $question->book_id])}}' " value="戻る">


</x-app-layout>
