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
                <div class="p-6 grid">
                    @foreach ($choices as $choice )
                        <a href="@if ($choice === $answer)
                                {{route('question.answer', ['id' => $question->id])}}
                                @else
                                {{route('question.wrong_answer', ['id' => $question->id])}}
                                @endif" class="text-base text-center mb-4 px-3 py-2 shadow-lg border border-gray-300 text-gray-900 rounded-t-md rounded-b-md w-full">
                                {{$choice}}
                        </a>
                    @endforeach
                    <div class="flex justify-between">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor onclick=" onclick=location.href='{{route('show', ['id' => $question->book_id])}}' ">
                            <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        @if ($question->book->user_id === Auth::id())
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor" onclick="location.href='{{route('question.edit', ['id' => $question->id])}}' ">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
