<!DOCTYPE html>
<html lang="en">

<head>
    <title>Post Details</title>
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
            @foreach($post_img_adr as $key=>$value)
            <div class="carousel-item">
                <img src='{{$value->post_img}}' alt="" width="376"
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
        <div class="card" width=375 >
            <a class="potrait" href=""><img src='{{$portrait}}'
                                            alt="Card image" width=50 height=50></a>
            @if ($data->liked)
                <form action="/build/public/likePost/{{$pid}}" method="get">
                    <button id="liked"></button>
                </form>
            @else
                <form action="/build/public/unlikePost/{{$pid}}" value="pid/{{$pid}}">
                    <button id="unliked"></button>
                </form>
            @endif

            <div class="card-body">
                <b>
                    <p class="exp-title">{{$title}}</p>
                </b>
                <div class="tags">
                    <div class="tag">{{$tag}}</div>
                </div>
                <div class="stars">
                    @for($i=0; $i<$rating;$i++)
                        <img src="http://localhost/build/resources/images/star.png" class="star_icon"/>
                    @endfor
                    {{--                    <p class="review">(2387 reviewed)</p>--}}
                </div>
                <div class="exp-intro">
                    <p>{{$detail}}</p>
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
                                @for($i=0; $i<$value->rating;$i++)
                                    <img src="http://localhost/build/resources/images/star.png" class="star_icon" />
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
{{--    <div id = "div-body">--}}
{{--        <div class="comment-input">--}}
{{--            <button type="button" class="btn btn-primary btn-block comment-button" id="commentPost">--}}
{{--                <img src="http://localhost/build/resources/images/event/comment-dots.png" width=28 height=28>--}}
{{--                <p>Comment</p>--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div id = "div-body">
        <div class="comment-input">
            <span class="btn btn-primary btn-block comment-button" id="commentPost">
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

</html>
<?php

