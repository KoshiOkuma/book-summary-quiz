<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            プロフィール編集
        </h2>
    </x-slot>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
<form action="{{ route('mypage.update') }}" method="POST">
    @csrf
    <label for="answer">名前</label>
    <input type="text" name="name" value="{{$user->name}}">
    <label for="fail1">Email</label>
    <input type="text" name="email" value="{{$user->email}}">
    <input type="button" onclick="location.href='{{route('mypage.index')}}' " value="戻る">
    <input type="submit" value="更新">
</form>


</x-app-layout>
