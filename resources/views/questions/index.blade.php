<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-flash-message status="session('status')" />

    @foreach ($questions as $question )
    Question:<a href="{{route('question.show', ['id' =>$question['id']])}}">{{$question['content']}}</a>
    <br>
    @endforeach

</x-app-layout>
