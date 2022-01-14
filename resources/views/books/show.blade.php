<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <img src="{{ Storage::url($book->image)}}">
    <div>title::{{$book->title}}</div>
    <div>author::{{$book->author}}</div>
    @if ($book->summary)
    <div>summary::{{$book->summary->content}}</div>
    @endif
    <div>by {{$book->user->name}}</div>
    @if (is_null($book->summary))
    <input type="button" onclick="location.href='{{route('summary.create', ['id' => $book->id])}}' " value="要約の作成">
    @endif
    @if ($book->summary)
    <input type="button" onclick="location.href='{{route('summary.edit', ['id' => $book->id])}}' " value="要約の編集">
    @endif
    <input type="button" onclick="location.href='{{route('index')}}' " value="戻る">
</body>
</html>


