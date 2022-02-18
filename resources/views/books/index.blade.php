<x-app-layout>
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
                            @if (str_starts_with($book->image, 'p') )
                                <img class="h-40 mb-4" src="{{ asset(Storage::url($book->image))}}" alt="">
                            @else
                                <img class="h-40 mb-4" src="{{ $book->image}}" alt="">
                            @endif
                        </a>
                        <div>
                            タイトル：<span class="text-lg text-gray-900 font-medium title-font mb-2">{{$book->title}}</span>
                        </div>
                        <div>
                            著者：<span class="text-lg text-gray-800 font-medium title-font mb-2">{{$book->author}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4">{{$books->links()}}</div>
        </div>
    </section>

</x-app-layout>
