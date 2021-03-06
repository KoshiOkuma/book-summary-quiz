<x-app-layout>
    <x-flash-message status="session('status')" />
    <section class="text-black body-font">
        <div class="container px-5 py-6 mx-auto">
            <x-flash-message status="session('status')" />
            <div class="flex flex-wrap w-full">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">クイズ一覧</h1>
                    <div class="h-1 w-36 bg-blue-500 rounded"></div>
                </div>
            </div>
            <div class="flex flex-wrap -m-4">
                @foreach ($questions as $question )
                <div class="xl:w-1/4 md:w-1/2 p-4">
                    <div class="bg-slate-50 p-6 rounded-lg inline-flex">
                        @if (str_starts_with($question->book->image, 'p') )
                            <img class="h-40 mb-4" src="{{ asset(Storage::url($question->book->image))}}" alt="">
                        @else
                            <img class="h-40 mb-4" src="{{ $question->book->image}}" alt="">
                        @endif
                        <a href="{{route('question.show', ['id' =>$question['id']])}}" class="ml-4 self-center">{{$question['content']}}</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div>{{$questions->links()}}</div>
        </div>
    </section>

</x-app-layout>
