<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="title">タイトル</label>
    <input type="text" name="title">
    <label for="author">著者</label>
    <input type="text" name="author">
    <label for="image">画像</label>
    <input type="file" name="image" id="image" accept="image/png,image/jpeg,image/jpg">
    <input type="button" onclick="location.href='{{route('index')}}' " value="戻る">
    <input type="submit" value="送信">
</form>
</body>
</html>
