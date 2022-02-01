<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            本一覧
        </h2>
    </x-slot> --}}
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-6 mx-auto">
            <x-flash-message status="session('status')" />
            <div class="flex flex-wrap w-full">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">本一覧</h1>
                    <div class="h-1 w-20 bg-blue-500 rounded"></div>
                </div>
            </div>
            <div class="flex flex-wrap -m-4">
                @foreach ($books as $book )
                <div class="xl:w-1/4 md:w-1/2 p-4">
                    <div class="bg-slate-50 p-6 rounded-lg">
                        <a href="{{route('show', ['id' => $book->id])}}">
                            <img class="h-40 rounded mb-4" src="{{ Storage::url($book->image)}}" alt="">
                        </a>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-2">タイトル：{{$book->title}}</h2>
                        <h3 class="text-lg text-gray-800 font-medium title-font mb-2">著者：{{$book->author}}</h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</x-app-layout>
