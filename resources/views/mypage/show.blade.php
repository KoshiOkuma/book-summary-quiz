<x-app-layout>
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
                        @if (str_starts_with($deletedBook[0]->image, 'p') )
                            <img class="h-40 mb-4" src="{{ asset(Storage::url($deletedBook[0]->image))}}" alt="">
                        @else
                            <img class="h-40 mb-4" src="{{ $deletedBook[0]->image}}" alt="">
                        @endif
                        <div class="text-lg text-gray-900 font-medium title-font mb-2">
                            <div>タイトル：{{$deletedBook[0]->title}}</div>
                            <div>著者：{{$deletedBook[0]->author}}</div>
                            <div>by {{$deletedBook[0]->user->name}}</div>
                            {{-- @if ($book->user_id === Auth::id()) --}}
                            <div class="flex justify-between mt-2">
                                <div>
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor" onclick="location.href='{{route('edit', ['id' => $deletedBook[0]->id])}}' ">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg> --}}
                                </div>
                                <div>
                                    <form id="restore_{{ $deletedBook[0]->id }}" action="{{ route('mypage.restore',['id' => $deletedBook[0]->id] )}}" method="post">
                                        @csrf
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor" data-id="{{ $deletedBook[0]->id }}" onclick="restoreBook(this)">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                    </form>
                                </div>
                            </div>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
                <div class="xl:w-1/2 md:w-1/2 p-4">
                    <div class="bg-slate-50 p-6 rounded-lg">
                        <div class="text-lg text-gray-900 font-medium title-font mb-2 grid">
                            <h2 class="sm:text-2xl text-xl font-medium title-font mb-1 text-gray-900">問題</h2>
                            <div class="h-1 w-12 bg-blue-300 rounded"></div>
                            @if ($deletedBook[0]->question->toArray())
                                @foreach ($deletedBook[0]->question as $question)
                                <div class="inline-flex">
                                    <a href="{{route('question.show', ['id' =>$question['id']])}}" class="mt-2">・{{$question['content']}}</a>
                                    <form id="delete_{{ $question->id }}" action="{{ route('question.destroy',['id' => $question->id] )}}" method="post">
                                        @csrf
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-10 mt-3 ml-1" viewBox="0 0 20 20" fill="currentColor" data-id="{{ $question->id }}" onclick="deleteQuestion(this)">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </form>
                                </div>
                                    @endforeach
                                <br>
                                <div class="mt-2 text-sm text-gray-600">※問題を編集、削除するには本の公開が必要です</div>

                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-2 justify-self-end text-blue-400" viewBox="0 0 20 20" fill="currentColor" onclick="location.href='{{route('question.create', ['id' => $deletedBook[0]->id])}}' ">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                    </svg> --}}
                            {{-- @elseif ($book->question->toArray() && $book->user_id !== Auth::id())
                                @foreach ($book->question as $question)
                                <a href="{{route('question.show', ['id' =>$question['id']])}}" class="mt-2">・{{$question['content']}}</a>
                                @endforeach
                            @elseif (!$book->question->toArray() && $book->user_id === Auth::id())
                                <div class="mt-2">まだ問題が登録されていません</div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-2 justify-self-end text-blue-400" viewBox="0 0 20 20" fill="currentColor" onclick="location.href='{{route('question.create', ['id' => $book->id])}}' ">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg> --}}
                            @else
                                <div class="mt-2">まだ問題が登録されていません</div>
                                <br>
                                <div class="mt-2 text-sm text-gray-600">※問題を登録するには本の公開が必要です</div>
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
                        @if ($deletedBook[0]->summary )
                            <div class="whitespace-pre-wrap mt-2">{{$deletedBook[0]->summary->content}}</div>
                            <br>
                            <div class="mt-2 text-sm text-gray-600">※要約を編集、削除するには本の公開が必要です</div>
                            {{-- <div class="inline-flex justify-end ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor" onclick="location.href='{{route('summary.edit', ['id' => $deletedBook[0]->id])}}' ">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                <form id="delete_{{ $deletedBook[0]->summary->id }}" action="{{ route('summary.destroy',['id' => $deletedBook[0]->summary->id] )}}" method="post" class="justify-self-end">
                                    @csrf
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-10 " viewBox="0 0 20 20" fill="currentColor" data-id="{{ $deletedBook[0]->summary->id }}" onclick="deleteSummary(this)">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <input type="hidden" name="deletedBook[0]_id" value="{{$deletedBook[0]->id}}">
                                </form>
                            </div> --}}
                        {{-- @elseif ($book->summary)
                            <div class="whitespace-pre-wrap mt-2">{{$book->summary->content}}</div>
                        @elseif (!$book->summary && $book->user_id === Auth::id())
                            <div class="mt-2">まだ要約が登録されていません</div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 justify-self-end text-blue-400" viewBox="0 0 20 20" fill="currentColor" onclick="location.href='{{route('summary.create', ['id' => $book->id])}}' ">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg> --}}
                        @else
                            <div class="mt-2">まだ要約が登録されていません</div>
                            <br>
                            <div class="mt-2 text-sm text-gray-600">※要約を登録するには本の公開が必要です</div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function restoreBook(e) {
            'use strict'
            if(confirm('本当に公開しますか？')){
                document.getElementById('restore_' + e.dataset.id).submit();
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
