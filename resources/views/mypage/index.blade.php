<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            マイページ
        </h2>
    </x-slot>
    <section class="body-font">
        <div class="container px-5 py-8 mx-auto">
            <x-flash-message status="session('status')" />
            <div class="flex flex-wrap w-full">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">マイページ</h1>
                    <div class="h-1 w-32 bg-blue-500 rounded"></div>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <div class="bg-white font-semibold text-center rounded-3xl border shadow-lg p-6 max-w-xs">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div>{{$user->name}}さんのプロフィール</div>
                    <form action="{{ route('mypage.update') }}" method="POST" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        <input type="file" name="avator" id="avatar" accept="image/png,image/jpeg,image/jpg" class="text-sm text-gray-700">
                        <img class="my-4 w-32 h-32 rounded-full shadow-lg mx-auto" src="{{ Storage::url($user->avator)}}">
                        <div>
                            <label for="answer" class="text-md text-gray-700">Name</label>
                            <input type="text" name="name" value="{{$user->name}}" class="appearance-none rounded-none px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>
                        <div>
                            <label for="email" class="text-md text-gray-700">Email</label>
                            <input type="text" name="email" value="{{$user->email}}" class="appearance-none rounded-none px-3 py-2 mt-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>
                        <input type="submit" value="プロフィール更新" class="bg-blue-400 text-white p-2 mt-2 rounded-md">
                        </form>
                </div>
            </div>
        </div>
    </section>

    <section class="body-font">
        <div class="container px-5 py-12 mx-auto">
            <div class="flex flex-wrap w-full">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                    <h2 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">My Books</h2>
                    <div class="h-1 w-32 bg-blue-500 rounded"></div>
                </div>
            </div>
            <div class="flex flex-wrap -m-4">
                @foreach ($myBooks as $myBook )
                <div class="p-4">
                    <div class="bg-slate-50 p-6 rounded-lg">
                        <a href="{{route('show', ['id' => $myBook->id])}}">
                            <img class="h-40 rounded mb-4" src="{{ Storage::url($myBook->image)}}" alt="">
                        </a>
                        <div class="text-lg text-gray-900 font-medium title-font mb-2">タイトル：{{$myBook->title}}</div>
                        <div class="text-lg text-gray-800 font-medium title-font mb-2">著者：{{$myBook->author}}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @if ($notShowing->toArray())
        <section class="body-font">
            <div class="container px-5 py-12 mx-auto">
                <div class="flex flex-wrap w-full">
                    <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                        <h3 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">非表示リスト</h3>
                        <div class="h-1 w-44 bg-blue-500 rounded"></div>
                    </div>
                </div>
                <div class="flex flex-wrap -m-4">
                    @foreach ($notShowing as $notShow )
                    <div class="xl:w-1/4 md:w-1/2 p-4">
                        <div class="bg-slate-50 p-6 rounded-lg">
                            <img class="h-40 rounded mb-4" src="{{ Storage::url($notShow->image)}}" alt="">
                            <div class="text-lg text-gray-900 font-medium title-font mb-2">タイトル：{{$notShow->title}}</div>
                            <div class="text-lg text-gray-800 font-medium title-font mb-2">著者：{{$notShow->author}}</div>
                            <form id="restore_{{ $notShow->id }}" action="{{ route('mypage.restore',['id' => $notShow->id] )}}" method="post">
                                @csrf
                                <input type="button" value="公開する" data-id="{{ $notShow->id }}" onclick="restoreBook(this)" class="bg-blue-400 text-white p-2 mb-2 rounded-sm inline-block">
                            </form>
                            <form id="delete_{{ $notShow->id }}" action="{{ route('mypage.forceDestroy',['id' => $notShow->id] )}}" method="post">
                                @csrf
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" data-id="{{ $notShow->id }}" onclick="forceDeleteBook(this)">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <script>
        function restoreBook(e) {
            'use strict'
            if(confirm('本当に公開しますか？')){
                document.getElementById('restore_' + e.dataset.id).submit();
            }
        }

        function forceDeleteBook(e) {
            'use strict'
            if(confirm('完全に削除しますか？この動作は元に戻すことができません。')){
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
