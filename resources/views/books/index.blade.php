<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($books as $book )
    title:: <a href="{{route('show', ['id' => $book->id])}}">{{$book->title}}</a>
    <br>
    @endforeach

    <input type="button" onclick="location.href='{{route('create')}}' " value="新規作成">
    @foreach ($notShowing as $notShow )
    <div>{{$notShow->title}}</div>
    @endforeach
</body>
</html>


