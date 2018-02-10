<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Body</th>
    </tr>
@if(isset($contents))
    @foreach($contents as $content)
    <tr>
            <td>{{$content['i']+1}}</td>
            <td>{{$content['title']}}</td>
            <td>{{$content['content']}}</td>
    </tr>
    @endforeach
@endif
</table>

</body>
</html>