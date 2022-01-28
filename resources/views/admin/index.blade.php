<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            本一覧
        </h2>
    </x-slot>
    <x-flash-message status="session('status')" />
    @foreach ($users as $user )
    <div>name:{{$user->name}}</div>
    <div>email:{{$user->email}}</div>
    @endforeach

</x-app-layout>
