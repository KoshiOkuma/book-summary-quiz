<x-app-layout>
    <x-flash-message status="session('status')" />
    @foreach ($users as $user )
    <div>name:{{$user->name}}</div>
    <div>email:{{$user->email}}</div>
    <form id="delete_{{ $user->id }}" action="{{ route('admin.destroy',['id' => $user->id] )}}" method="post">
        @csrf
        <a href="#" data-id="{{ $user->id }}" onclick="deleteUser(this)">削除</a>
    </form>
    @endforeach
    
    <script>
        function deleteUser(e) {
            'use strict'
            if(confirm('本当に削除しますか？')){
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
