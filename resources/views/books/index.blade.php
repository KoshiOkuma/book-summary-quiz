<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            本一覧
        </h2>
    </x-slot> --}}
    <x-flash-message status="session('status')" />
    @foreach ($books as $book )
    title: <a href="{{route('show', ['id' => $book->id])}}">{{$book->title}}</a>
    <br>
    @endforeach
    <input type="button" onclick="location.href='{{route('create')}}' " value="新規作成">


    <section class="text-gray-600 body-font">
        <div class="container px-5 py-12 mx-auto">
            <div class="flex flex-wrap w-full mb-20">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">本一覧</h1>
                    <div class="h-1 w-20 bg-blue-500 rounded"></div>
                </div>
            </div>
            <div class="flex flex-wrap -m-4">
                @foreach ($books as $book )
                <div class="xl:w-1/4 md:w-1/2 p-4">
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <a href="{{route('show', ['id' => $book->id])}}">
                            <img class="h-40 rounded mb-4" src="{{ Storage::url($book->image)}}" alt="">
                        </a>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-2">タイトル：{{$book->title}}</h2>
                        <h3 class="text-lg text-gray-500 font-medium title-font mb-2">著者：{{$book->author}}</h3>
                        <h4 class="text-lg text-gray-500 font-medium title-font">Created by:{{$book->user->name}}</h4>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</x-app-layout>
