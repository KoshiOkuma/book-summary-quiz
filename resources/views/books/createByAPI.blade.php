<x-app-layout>
    {{-- <form action="{{route('createByAPI')}}" method="get">
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
            @else
                <img src="{{asset('images/no_image.jpg')}}" alt="">
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
    @endif --}}

    <!-- component -->

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-6 mx-auto">
            <div class="flex flex-wrap w-full">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">本の登録</h1>
                    <div class="h-1 w-28 bg-blue-500 rounded"></div>
                </div>
            </div>
            <form action="{{route('createByAPI')}}" method="get">
                <span class="inline-flex my-4">
                    <input type="text" name="keyword" size="50" value="{{ $data['keyword'] }}" class="w-full px-4 py-1 text-gray-800 rounded-full focus:outline-none" placeholder="書籍名を入力してください">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-1 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </span>
                {{-- <input type="submit" value="検索"> --}}
            </form>
            <div class="flex flex-wrap -m-4">
                @if ($data['items'] == null)
                    {{-- <p>書籍名を入力してください。</p> --}}
                @else
                    @foreach ($data['items'] as $item)
                    <form action="{{ route('storeByAPI') }}" method="POST" id="create_{{ $item['id'] }}">
                    @csrf
                    <div class="p-4">
                        <div class="bg-slate-50 p-6 rounded-lg">
                            @if (array_key_exists('imageLinks', $item['volumeInfo']))
                                <img src="{{ $item['volumeInfo']['imageLinks']['thumbnail']}}" onclick="confirmCreate(this)" data-id="{{ $item['id'] }}"><br>
                                <input type="hidden" name="image" value="{{ $item['volumeInfo']['imageLinks']['thumbnail']}}">
                            @else
                                <img src="{{asset('images/no_image2.png')}}" class="mb-2">
                            @endif
                            <h2 onclick="confirmCreate(this)" data-id="{{ $item['id'] }}">「{{ $item['volumeInfo']['title']}}」</h2>
                            <input type="hidden" name="title" value="{{ $item['volumeInfo']['title']}}">
                            @if (array_key_exists('authors', $item['volumeInfo']))
                                <div onclick="confirmCreate(this)" data-id="{{ $item['id'] }}">
                                    著者：{{ $item['volumeInfo']['authors'][0]}}
                                </div>
                                <input type="hidden" name="author" value="{{ $item['volumeInfo']['authors'][0]}}">
                            @endif
                            @if (array_key_exists('description', $item['volumeInfo']))
                                {{-- <div onclick="confirmCreate(this)" data-id="{{ $item['id'] }}">
                                    概要：{{ $item['volumeInfo']['description']}}
                                </div> --}}
                                <input type="hidden" name="description" value="{{ $item['volumeInfo']['description']}}">
                            @endif
                        </div>
                        <br>
                        <hr>
                    </div>
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
