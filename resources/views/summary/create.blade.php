<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
<form action="{{ route('summary.store') }}" method="POST">
    @csrf
    <textarea name="content"cols="30" rows="10"></textarea>
    <input type="hidden" name="book_id" value="{{$id}}">
    <input type="button" onclick="location.href='{{route('index')}}' " value="戻る">
    <input type="submit" value="送信">
</form>

</x-app-layout>
