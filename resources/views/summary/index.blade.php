<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            要約一覧
        </h2>
    </x-slot>

    <x-flash-message status="session('status')" />

    @foreach ($summaries as $summary )
    <div>title:{{$summary->book->title}}</div>
    <div>title:{{$summary->content}}</div>
    @endforeach

</x-app-layout>
