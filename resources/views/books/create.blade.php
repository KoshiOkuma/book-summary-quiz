<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            本の作成
        </h2>
    </x-slot>

<form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="title">タイトル</label>
    <input type="text" name="title">
    <label for="author">著者</label>
    <input type="text" name="author">
    <label for="image">画像</label>
    <input type="file" name="image" id="image" accept="image/png,image/jpeg,image/jpg">
    <input type="button" onclick="location.href='{{route('index')}}' " value="戻る">
    <input type="submit" value="送信">
</form>

</x-app-layout>
