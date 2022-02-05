<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            クイズ表示
        </h2>
    </x-slot>
    <div class="container px-5 sm:py-24">
        <div class="sm:flex ">
            <div class="px-4 mx-auto invisible sm:visible ">
                <div class="bg-white p-2 rounded-lg">
                    <a href="{{route('show', ['id' => $book->id])}}">
                        <img class="h-40 mb-4" src="{{ Storage::url($book->image)}}" alt="">
                    </a>
                    <div class="text-lg text-gray-900 font-medium title-font mb-2">
                        <div>タイトル：{{$book->title}}</div>
                        <div>著者：{{$book->author}}</div>
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
                    @if ($question->book->user_id === Auth::id())
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 justify-self-end" viewBox="0 0 20 20" fill="currentColor" onclick="location.href='{{route('question.edit', ['id' => $question->id])}}' ">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 sm:flex-row flex-col items-center">
            <div class="lg:w-1/4 sm:w-1/2 p-4 invisible sm:visible ">
                <div class="bg-white p-2 rounded-lg">
                    <div class="lg:max-w-md lg:w-full sm:w-1/2 w-5/6 mb-10 sm:mb-0">
                      <img class="object-cover object-center rounded" alt="hero" src="{{ Storage::url($book->image)}}">
                    </div>
                    <div class="text-lg text-gray-900 font-medium title-font mb-2">
                        <div>タイトル：{{$book->title}}</div>
                        <div>著者：{{$book->author}}</div>
                    </div>
                </div>
            </div>
          <div class="lg:flex-grow sm:w-1/2 lg:pl-24 sm:pl-16 flex flex-col sm:items-start sm:text-left items-center text-center">
            <div class="w-full max-w-md mx-auto shadow-lg rounded-lg">
                <div class="px-3 py-2 text-white font-extrabold bg-blue-400 text-lg shadow-lg">
                    {{$question->content}}
                </div>
                <div class="bg-white px-6 pt-3 pb-6">
                    @foreach ($choices as $choice )
                    <div class="mb-4 px-3 py-2 shadow-lg border border-gray-300 text-gray-900 rounded-t-md rounded-b-md sm:text-sm w-full">
                        <a href="@if ($choice === $answer)
                                {{route('question.answer', ['id' => $question->id])}}
                                @else
                                {{route('question.wrong_answer', ['id' => $question->id])}}
                                @endif" class="text-base">
                                {{$choice}}
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
          </div>
        </div>
      </section> --}}
</x-app-layout>
