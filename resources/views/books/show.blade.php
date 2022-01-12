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
    @foreach ($summaries as $summary )
    <div>summary::{{$summary['content']}}</div>
    @endforeach

    <input type="button" onclick="location.href='{{route('summary.create', ['id' => $book->id])}}' " value="要約の作成">
</body>
</html>


