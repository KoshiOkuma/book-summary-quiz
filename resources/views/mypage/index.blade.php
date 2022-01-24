<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-flash-message status="session('status')" />
    <form action="{{ route('mypage.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="avator">画像</label>
        <input type="file" name="avator" id="avatar" accept="image/png,image/jpeg,image/jpg">
        <input type="submit" value="画像登録">
    </form>
    <img src="{{ Storage::url($user->avator)}}">
    <div>{{$user->name}}</div>
    <div>{{$user->email}}</div>

    <input type="button" onclick="location.href='{{route('mypage.edit')}}' " value="プロフィール編集">



</x-app-layout>
