<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<br>
<div class="container">
    <div class="row">
        <div class="offset-md-1 col-md-10">
            <div class="card">
                <div class="card-header">
                    <button type="submit" class="btn btn-success start">Start</button>
                    <button type="submit" class="btn btn-success clear">Clear</button>
                    <button type="submit" class="btn btn-success save">Save to Database</button>
                </div>
                <div class="card-block" id="items">
                    <p class="card-text">
                        <ul class="list-group mx-5">
                            <p class="time"></p>
                    @if(isset($contents))
                        @foreach($contents as $content)
                            <li class="list-group-item"  id="title">
                                <p>{{$content['i']+1}}</p>
                                <p class="time{{$content['i']}}">{{$content['time']}}</p>
                                <h5><a href="{{$content['url']}}" class="url{{$content['i']}}">{{$content['title']}}</a></h5>
                                <p class="content{{$content['i']}}">{{$content['content']}}</p>
                            </li>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @endforeach
                    @endif
                        </ul>
                    </p>
                </div>
            </div>
        </div>

    </div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
</div>



<script>
    $('.list-group-item').hide();
    $('.start').click(function () {
        $('.list-group-item').show();
    });

    $('.clear').click(function () {
        $('.list-group-item').hide();
    });




    $('.save').click(function () {
        var id = {{$content['i']}};

        for(var i = 0; i < id; i++)
        {
            var time =  $('.time' + i).text();
            var url = $('.url' + i).attr('href');
            var title = $('.url' + i).text();
            var content = $('.content' + i).text();
            $.ajax({
                type: 'POST',
                url: 'save',
                data: {time:time, url:url, title:title, content:content, _token:$('input[name=_token]').val()}
            })
                .done(function (data) {
                    console.log(data);
                })
                .fail(function () {
                    alert('Failed');
                });

        }
    });
</script>
</body>
</html>