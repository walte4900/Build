{{-- <!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, viewport-fit=cover initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="http://localhost/build/resources/css/profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Profile page</title>
</head> --}}

@extends('layouts.app')

@section('content')

<body id="edit">
<section id = "profile">
    <img src="http://localhost/build/resources/images/profile/Elizabeth.jpg" class="avatar">
    <h3>{{$username->username}}</h3>
    <div>
        <ul id="profilebar">
            <li >
                <a href="#">{{count($data)}}</a>
                <p>Posts</p>
            </li>
            <li>
                <a href="#">{{$followed}}</a>
                <p>Followings</p>
            </li>
            <li>
                <a href="#">{{$follower}}</a>
                <p>Followers</p>
            </li>
            <li >
                <a href="{{url("user/coupon")}}">{{$coupon}}</a>
                <p>Coupons</p>
            </li>
        </ul>
    </div>
    <div class="settings">
        <a href = "{{url('user/setting')}}">
            <img src="http://localhost/build/resources/images/profile/settings.png"></a>
    </div>
</section>
<section>
<div style="height:20px;weight:100%;"></div>
    @foreach($data as $value)
        <div class="card" style="width: 94%; margin: 0px 10px; border-radius: 15px; border: 2px solid #F5F1F2" value='{{$value->which_id}}\{{$value->id}}'>
                <img src="{{$value->cover_img}}" class="card-img-top" style="border-radius: 15px 15px 0px 0px; height:180px" alt="travel2"></a>
            <div class="card-body" style="padding: 10px;">
                <h6 class="card-title">{{$value->title}}</h6>
                <span class="d-inline-block text-truncate text-muted" style="max-width: 100%;">{{$value->detail}}</span>
            </div>
        </div>
        <div style="height:20px;weight:100%;"></div>
    @endforeach
    <script type="text/javascript">
        $(function () {
            $(".card").click(function () {
                let which_id = this.getAttribute("value").split("\\")[0];
                let id = this.getAttribute("value").split("\\")[1];
                if (which_id === "eid") {
                    window.location.href = 'http://localhost/build/public/eventDetails/' + id;
                } else {
                    window.location.href = 'http://localhost/build/public/postDetails/' + id;
                }
            });
        });
    </script>
</section>

{{-- </body>
</html> --}}


@endsection
