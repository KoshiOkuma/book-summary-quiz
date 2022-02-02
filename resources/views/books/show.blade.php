<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            本の表示
        </h2>
    </x-slot>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-6 mx-auto">
                <x-flash-message status="session('status')" />
                <div class="flex flex-wrap w-full">
                    <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">本の詳細</h1>
                        <div class="h-1 w-28 bg-blue-500 rounded"></div>
                    </div>
                </div>
                <div class="flex flex-wrap -m-4">
                    <div class="xl:w-1/4 md:w-1/2 p-4">
                        <div class="bg-slate-50 p-2 rounded-lg">
                            <img class="h-40 mb-4" src="{{ Storage::url($book->image)}}" alt="">
                            <div class="text-lg text-gray-900 font-medium title-font mb-2">
                                <div>タイトル：{{$book->title}}</div>
                                <div>著者：{{$book->author}}</div>
                                <div>by {{$book->user->name}}</div>
                                @if ($book->user_id === Auth::id())
                                <div class="flex justify-between mt-2">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor" onclick="location.href='{{route('edit', ['id' => $book->id])}}' ">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <form id="delete_{{ $book->id }}" action="{{ route('destroy',['id' => $book->id] )}}" method="post">
                                            @csrf
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" data-id="{{ $book->id }}" onclick="deleteBook(this)">
                                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                              </svg>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="xl:w-1/2 md:w-1/2 p-4">
                        <div class="bg-slate-50 p-6 rounded-lg">
                            <div class="text-lg text-gray-900 font-medium title-font mb-2 grid">
                                <h2 class="sm:text-2xl text-xl font-medium title-font mb-1 text-gray-900">問題</h2>
                                <div class="h-1 w-12 bg-blue-300 rounded"></div>
                                @if ($book->question->toArray() && $book->user_id === Auth::id())
                                    @foreach ($book->question as $question)
                                    <div class="inline-flex">
                                        <div class="mt-2">
                                        ・<a href="{{route('question.show', ['id' =>$question['id']])}}">{{$question['content']}}</a>
                                        </div>
                                        <form id="delete_{{ $question->id }}" action="{{ route('question.destroy',['id' => $question->id] )}}" method="post">
                                            @csrf
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-10 mt-3" viewBox="0 0 20 20" fill="currentColor" data-id="{{ $question->id }}" onclick="deleteQuestion(this)">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            <input type="hidden" name="book_id" value="{{$question->book_id}}">
                                        </form>
                                    </div>
                                        @endforeach
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-2 justify-self-end text-blue-400" viewBox="0 0 20 20" fill="currentColor" onclick="location.href='{{route('question.create', ['id' => $book->id])}}' ">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                        </svg>
                                @elseif (!$book->question->toArray() && $book->user_id === Auth::id())
                                    <div>まだ問題が登録されていません</div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-2 justify-self-end text-blue-400" viewBox="0 0 20 20" fill="currentColor" onclick="location.href='{{route('question.create', ['id' => $book->id])}}' ">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <div>まだ問題が登録されていません</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xl:w-full md:w-full p-4 -m-4">
                    <div class="bg-slate-50 p-6 rounded-lg">
                        <div class="text-lg text-gray-900 font-medium title-font mb-2 grid">
                            <h3 class="sm:text-2xl text-xl font-medium title-font mb-1 text-gray-900">要約</h3>
                            <div class="h-1 w-12 bg-blue-300 rounded"></div>
                            @if ($book->summary && $book->user_id === Auth::id())
                                <div class="whitespace-pre-wrap mt-2">{{$book->summary->content}}</div>
                                <div class="inline-flex justify-end ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor" onclick="location.href='{{route('summary.edit', ['id' => $book->id])}}' ">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                    <form id="delete_{{ $book->summary->id }}" action="{{ route('summary.destroy',['id' => $book->summary->id] )}}" method="post" class="justify-self-end">
                                        @csrf
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-10 " viewBox="0 0 20 20" fill="currentColor" data-id="{{ $book->summary->id }}" onclick="deleteSummary(this)">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <input type="hidden" name="book_id" value="{{$book->id}}">
                                    </form>
                                </div>
                            @elseif ($book->summary)
                                <div class="whitespace-pre-wrap mt-2">{{$book->summary->content}}</div>
                            @elseif (!$book->summary && $book->user_id === Auth::id())
                                <div>まだ要約が登録されていません</div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 justify-self-end text-blue-400" viewBox="0 0 20 20" fill="currentColor" onclick="location.href='{{route('summary.create', ['id' => $book->id])}}' ">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                            @else
                                <div>まだ要約が登録されていません</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <script>
        function deleteBook(e) {
            'use strict'
            if(confirm('本当に非公開にしますか？')){
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }

        function deleteSummary(e) {
            'use strict'
            if(confirm('本当に削除しますか？この操作は元に戻すことができません。')){
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
        function deleteQuestion(e) {
        'use strict'
        if(confirm('本当に削除しますか？この操作は元に戻すことができません。')){
            document.getElementById('delete_' + e.dataset.id).submit();
        }
    }

    </script>

</x-app-layout>
