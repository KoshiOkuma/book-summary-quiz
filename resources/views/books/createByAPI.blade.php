<x-app-layout>
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

    <script>
        function confirmCreate(e) {
            'use strict'
            if(confirm('この本を登録しますか？')){
                document.getElementById('create_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
