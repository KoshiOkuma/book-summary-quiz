<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            要約の作成
        </h2>
    </x-slot>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
<form action="{{ route('summary.store') }}" method="POST">
    @csrf
    <textarea name="content"cols="30" rows="10">{{old('content')}}</textarea>
    <input type="hidden" name="book_id" value="{{$id}}">
    <input type="button" onclick="location.href='{{route('show', ['id' => $id])}}' " value="戻る">
    <input type="submit" value="送信">
</form>

</x-app-layout>
