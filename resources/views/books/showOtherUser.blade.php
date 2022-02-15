<x-app-layout>
    <section class="body-font">
        <div class="container px-5 py-8 mx-auto">
            <x-flash-message status="session('status')" />
            <div class="flex flex-wrap w-full">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">{{$user->name}}さんのマイページ</h1>
                    <div class="h-1 w-32 bg-blue-500 rounded"></div>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <div class="bg-white font-semibold text-center rounded-3xl border shadow-lg p-6 max-w-xs">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div>{{$user->name}}さんのプロフィール</div>
                    {{-- <form action="{{ route('mypage.update') }}" method="POST" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        <input type="file" name="avatar" id="avatar" accept="image/png,image/jpeg,image/jpg" class="text-sm text-gray-700"> --}}
                        <img class="object-cover my-4 w-32 h-32 rounded-full shadow-lg mx-auto" src="{{ asset(Storage::url($user->avatar))}}">
                        <div class="text-base text-center mb-4 px-3 py-2 shadow-lg border border-gray-300 text-gray-900 rounded-t-md rounded-b-md w-full">{{$user->name}}
                            {{-- <label for="answer" class="text-md">Name</label>
                            <input type="text" name="name" value="{{$user->name}}" class="appearance-none rounded-none px-3 py-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"> --}}
                        </div>
                        {{-- <div>
                            <label for="email" class="text-md">Email</label>
                            <input type="text" name="email" value="{{$user->email}}" class="appearance-none rounded-none px-3 py-2 mt-2 border border-gray-300 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        </div>
                        <input type="submit" value="プロフィール更新" class="bg-blue-400 text-white p-2 mt-2 rounded-md">
                    </form> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-12 mx-auto">
            <div class="flex flex-wrap w-full">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                    <h2 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">登録した本</h2>
                    <div class="h-1 w-32 bg-blue-500 rounded"></div>
                </div>
            </div>
            <div class="flex flex-wrap -m-4">
                @foreach ($user->book as $myBook )
                <div class="p-4">
                    <div class="bg-slate-50 p-6 rounded-lg">
                        <a href="{{route('show', ['id' => $myBook->id])}}">
                            <img class="h-40 mb-4" src="{{ asset(Storage::url($myBook->image))}}" alt="">
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

</x-app-layout>
