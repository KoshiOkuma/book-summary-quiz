<x-app-layout>
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
                        <input type="file" name="avatar" id="avatar" accept="image/png,image/jpeg,image/jpg" class="text-sm text-gray-700">
                        <img class="object-cover my-4 w-32 h-32 rounded-full shadow-lg mx-auto" src="{{ asset(Storage::url($user->avatar))}}">
                        <div>
                            <label for="answer" class="text-md">Name</label>
                            <input type="text" name="name" value="{{$user->name}}" class="appearance-none rounded-none px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>
                        <div>
                            <label for="email" class="text-md">Email</label>
                            <input type="text" name="email" value="{{$user->email}}" class="appearance-none rounded-none px-3 py-2 mt-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>
                        <input type="submit" value="プロフィール更新" class="bg-blue-400 text-white p-2 mt-2 rounded-md">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="text-gray-600 body-font">
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
                            @if (str_starts_with($myBook->image, 'p') )
                                <img class="h-40 mb-4" src="{{ asset(Storage::url($myBook->image))}}" alt="">
                            @else
                                <img class="h-40 mb-4" src="{{ $myBook->image}}" alt="">
                            @endif
                        </a>
                        <div>
                            タイトル：<span class="text-lg text-gray-900 font-medium title-font mb-2">{{$myBook->title}}</span>
                        </div>
                        <div>
                            著者：<span class="text-lg text-gray-800 font-medium title-font mb-2">{{$myBook->author}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @if ($notShowing->toArray())
        <section class="text-gray-600 body-font">
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
                        <a href="{{route('mypage.showDeletedBook', ['id' => $notShow->id])}}">
                            @if (str_starts_with($notShow->image, 'p') )
                                <img class="h-40 mb-4" src="{{ asset(Storage::url($notShow->image))}}" alt="">
                            @else
                                <img class="h-40 mb-4" src="{{ $notShow->image}}" alt="">
                            @endif
                        </a>
                            <div>
                                タイトル：<span class="text-lg text-gray-900 font-medium title-font mb-2">{{$notShow->title}}</span>
                            </div>
                            <div>
                                著者：<span class="text-lg text-gray-800 font-medium title-font mb-2">{{$notShow->author}}</span>
                            </div>
                            <div class="inline-flex space-x-2">
                                <form id="restore_{{ $notShow->id }}" action="{{ route('mypage.restore',['id' => $notShow->id] )}}" method="post">
                                    @csrf
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor" data-id="{{ $notShow->id }}" onclick="restoreBook(this)">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                </form>
                                <form id="delete_{{ $notShow->id }}" action="{{ route('mypage.forceDestroy',['id' => $notShow->id] )}}" method="post">
                                    @csrf
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-10 text-red-400" viewBox="0 0 20 20" fill="currentColor" data-id="{{ $notShow->id }}" onclick="forceDeleteBook(this)">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </form>
                            </div>
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
            if(confirm('完全に削除しますか？この操作は元に戻すことができません。')){
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
