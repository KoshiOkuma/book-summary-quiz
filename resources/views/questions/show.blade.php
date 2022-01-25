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
        {{route('question.answer', ['id' => $question->id])}}
        @else
        {{route('question.wrong_answer', ['id' => $question->id])}}
        @endif">{{$choice}}</a>
        @endforeach
    </div>
    @if ($question->book->user_id === Auth::id())
    <input type="button" onclick="location.href='{{route('question.edit', ['id' => $question->id])}}' " value="問題の編集">
    @endif
    <input type="button" onclick="location.href='{{route('show', ['id' => $question->book_id])}}' " value="戻る">


</x-app-layout>
