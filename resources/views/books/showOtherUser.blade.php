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
                    <img class="object-cover my-4 w-32 h-32 rounded-full shadow-lg mx-auto" src="{{ asset(Storage::url($user->avatar))}}">
                    <div class="text-base text-center mb-4 px-3 py-2 shadow-lg border border-gray-300 text-gray-900 rounded-t-md rounded-b-md w-full">{{$user->name}}</div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-12 mx-auto">
            <div class="flex flex-wrap w-full">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                    <h2 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">登録した本</h2>
                    <div class="h-1 w-36 bg-blue-500 rounded"></div>
                </div>
            </div>
            <div class="flex flex-wrap -m-4">
                @foreach ($user->book as $myBook )
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

</x-app-layout>
