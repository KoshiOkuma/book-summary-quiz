<x-app-layout>
    <div class="container px-5 sm:py-24">
        <div class="sm:flex ">
            <div class="px-4 mx-auto invisible sm:visible ">
                <div class="bg-white p-2 rounded-lg">
                    <a href="{{route('show', ['id' => $question->book_id])}}">
                        @if (str_starts_with($question->book->image, 'p') )
                            <img class="h-40 mb-4" src="{{ asset(Storage::url($question->book->image))}}" alt="">
                        @else
                            <img class="h-40 mb-4" src="{{ $question->book->image}}" alt="">
                        @endif
                    </a>
                    <div class="text-lg text-gray-900 font-medium title-font mb-2">
                        <div>タイトル：{{$question->book->title}}</div>
                        <div>著者：{{$question->book->author}}</div>
                    </div>
                </div>
            </div>
            <div class="w-full max-w-md mx-auto shadow-lg rounded-b-lg bg-white">
                <div class="px-3 py-2 text-white font-extrabold bg-blue-400 text-lg rounded-t-lg shadow-lg">
                    {{$question->content}}
                </div>
                <div class="grid justify-items-center">
                    <div class="bg-green-300 w-1/2 text-center text-lg mt-2">
                        正解です!
                    </div>
                    <div class="border border-black rounded-md w-11/12 mt-2 ">
                        <div class="justify-self-start ml-4 pt-2">解答：</div>
                        <div class="text-base text-center mb-4 px-3 text-gray-900">{{$answer}}</div>
                    </div>
                    <div class="border-t-2 border-gray-300 w-11/12 mt-6 ">
                        <div class="justify-self-start ml-4 mt-2">解説：</div>
                        <div class="text-base text-center mb-4 px-3 py-2 text-gray-900">{{$question->description}}</div>
                    </div>
                </div>
                <div class="flex justify-between">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 justify-self-start ml-1 mb-1 -mt-2" viewBox="0 0 20 20" fill="currentColor onclick=" onclick=location.href='{{route('show', ['id' => $question->book_id])}}' ">
                        <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    <div class="-mt-3 pb-2 pr-2">
                        <a href="{{route('question.index') }}" class="underline text-sm text-gray-600 hover:text-gray-900 self-center">クイズ一覧へ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
