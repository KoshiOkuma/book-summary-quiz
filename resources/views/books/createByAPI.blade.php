<x-app-layout>
    <section class="body-font">
        <div class="w-full  bg-gray-100 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="flex flex-wrap w-full sm:max-w-md mx-auto pt-16">
                <div class="lg:w-1/2 w-full mb-6 ">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">本の登録</h1>
                    <div class="h-1 w-28 bg-blue-500 rounded"></div>
                </div>
            </div>
            <div class="w-full sm:max-w-md mx-auto bg-white rounded-3xl border shadow-lg p-6">
                <form action="{{route('createByAPI')}}" method="get">
                    書籍名:<input type="text" name="keyword" size="50" value="{{ $data['keyword'] }}">&nbsp;<input type="submit" value="検索">
                </form>
                @if ($data['items'] == null)
                    <p>書籍名を入力してください。</p>
                @else
                    <p>「{{ $data['keyword'] }}」の検索結果</p>
                    <hr>
                    @foreach ($data['items'] as $item)
                    <form action="{{ route('storeByAPI') }}" method="POST" id="create_{{ $item['id'] }}">
                    @csrf
                    <h2 onclick="confirmCreate(this)" data-id="{{ $item['id'] }}">{{ $item['volumeInfo']['title']}}</h2>
                    <input type="hidden" name="title" value="{{ $item['volumeInfo']['title']}}">
                        @if (array_key_exists('imageLinks', $item['volumeInfo']))
                            <img src="{{ $item['volumeInfo']['imageLinks']['thumbnail']}}" onclick="confirmCreate(this)" data-id="{{ $item['id'] }}"><br>
                            <input type="hidden" name="image" value="{{ $item['volumeInfo']['imageLinks']['thumbnail']}}">
                        @endif

                        @if (array_key_exists('authors', $item['volumeInfo']))
                            <div onclick="confirmCreate(this)" data-id="{{ $item['id'] }}">
                                著者：{{ $item['volumeInfo']['authors'][0]}}
                            </div>
                            <input type="hidden" name="author" value="{{ $item['volumeInfo']['authors'][0]}}">
                        @endif

                        @if (array_key_exists('description', $item['volumeInfo']))
                            <div onclick="confirmCreate(this)" data-id="{{ $item['id'] }}">
                                概要：{{ $item['volumeInfo']['description']}}
                            </div>
                            <input type="hidden" name="description" value="{{ $item['volumeInfo']['description']}}">
                        @endif
                        <br>
                        <hr>
                    </form>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <script>
        function confirmCreate(e) {
            'use strict'
            if(confirm('この本を登録しますか？')){
                document.getElementById('create_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
