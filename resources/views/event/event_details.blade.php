<!DOCTYPE html>
<html lang="en">

<head>
    <title>Event Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/build/resources/css/event-detail-page.css">


    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
<back></back>
<main>

    <a class="back2" href="{{url("/")}}">
        <img src="http://localhost/build/resources/images/event/back2.png" height=47 width=47 url="">
    </a>

    <div id="demo" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src='{{$first_img}}' alt="" width="376"
                     height="273">
                <div class="carousel-caption">
                </div>
            </div>
            @foreach($event_imgs as $key=>$value)
                <div class="carousel-item">
                    <img src='{{$value->event_img_adr}}' alt="" width="376"
                         height="273">
                    <div class="carousel-caption">
                    </div>
                </div>
            @endforeach
        </div>
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>
    </div>
    <div class="container">
        <div class="card" width=375 id="eid" value="1">
            <a class="logo" href=""><img src="http://localhost/build/resources/images/event/icons8-national-park-50.png"
                                         alt="Card image" width=50
                                         height=50></a>
            <!--img class="booking" src="http://localhost/build/resources/images/event/icon-appointment-2.png"
                    alt="Card image" width=50 height=50-->
            @if ($data->booked)
                <form action="/build/public/cancel/{{$eid}}" method="get">
                    @csrf
                    <button id="toCancel"></button>
                </form>
            @else
                <button id="toBook"></button>
            @endif
            <div class="card-body">
                <b>
                    <p class="exp-title">{{$title}}</p>
                </b>
                <div class="event-info">
                    <img class="event-time"
                         src="http://localhost/build/resources/images/event/event-date-and-time-symbol-green.png"
                         width="33" height="33">
                    <p>{{$start_date}}-<br>
                    {{$end_date}} </p>
                    <div class="navigation">
                        <div class="gps_icon"><img src="http://localhost/build/resources/images/GPS%20icon.png"
                            width="20" height="20"></div>
                        <div class="address"><p>{{$location}}</p></div>
                    </div>
                </div>
                <div class="event-intro">
                    <p>{{$first_para}}<br>{{$second_para}}</p>
                    <div id="gradient"></div>
                </div>
                <div id="read-more"></div>
            </div>
        </div>
    </div>
    </div>
    <div class="container" id="comments">
        <p class="title">Comments</p>
        <div class="container" id="comment">
            @foreach($comment_detail as $key=>$value)
                <div class="card">
                    <div class="info">
                        <a class="comment-potrait" href=""><img
                                src="{{$value->avatar}}" alt="portrait"
                                width=40 height=40></a>
                        <div class="name-rating">
                            <p>{{$value->uname}}</p>
                            <div class="stars_rating">
                                @for($i=0; $i<$value->rate;$i++)
                                <img src="http://localhost/build/resources/images/star.png" class="star_icon"/>
                                @endfor
                            </div>
                        </div>
                        <a class="comment-dot">
                            <img src="http://localhost/build/resources/images/event/comment-dots.png">
                        </a>
                    </div>
                    <div class="comment-text">
                        <p>{{$value->comment}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <form class="bookInfo" id="confirm-booking" action="/build/public/book/{{$eid}}">
        @csrf
        <h>Booking Succeed</h>
        <p>You have successfully booked a green tourism event and the event has been added to your favorites. Please
            go to favorites on the day of the event to check in. </p>
        <button name="confirm-booking" class="confirm-button">Done</button>
    </form>
    <div id = "div-body">
        <div class="comment-input">
            <span class="btn btn-primary btn-block comment-button" id="commentEvent">
                <img src="http://localhost/build/resources/images/event/comment-dots.png" width=28 height=28>
                <p id="comment_btn">Comment</p>
            </span>
        </div>
    </div>
</main>

</body>

<script src="http://localhost/build/resources/js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
<script src="http://localhost/build/resources/js/script-detail-pages.js"></script>
<script>
    $(document).ready(function () {
        $('.navigation').click(function () {
            {{--window.location.href = 'http://localhost/build/public/map/navigation/{{$eid}}';--}}
            {{--console.log({{$eid}});--}}
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                dataType:'json',
                url: 'http://localhost/build/public/map/navigation/{{$eid}}',
                data:{
                    "eid": {{$eid}},
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data.latitude);
                    window.location.href = 'http://localhost/build/public/map/'+data.latitude+'/'+data.longitude;
                }
            });
        });
    });
</script>
</html>

<?php
