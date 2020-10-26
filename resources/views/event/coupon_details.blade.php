<!DOCTYPE html>
<html lang="en">

<head>
    <title>Coupon Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
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
                <img src='{{$img}}' alt="" width="376"
                     height="273">
                <div class="carousel-caption">
                </div>
            </div>
            @foreach($imgs as $key=>$value)
                <div class="carousel-item">
                    <img src='{{$value->img}}' alt="" width="376"
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
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>
    </div>
    <div class="container">
        <div class="card" width=375>
            <a class="logo" href=""><img src="http://localhost/build/resources/images/event/icons8-national-park-50.png"
                                         alt="Card image" width=50
                                         height=50></a>
            <!--img class="booking" src="http://localhost/build/resources/images/event/icon-appointment-2.png"
                    alt="Card image" width=50 height=50-->

            <div class="card-body">
                <b>
                    <p class="exp-title">{{$title}}</p>
                </b>
                <div class="coupon-info">
                    <img class="event-time" src="http://localhost/build/resources/images/event/event-date-and-time-symbol-green.png" width="33" height="33">
                    <p>Expire at {{$expire}}</p>
                </div>
                <div class="coupon-intro">
                    <p>{{$detail}}</p>
                    <div id="gradient"></div>
                </div>
                <div id="read-more"></div>
            </div>
        </div>
    </div>
    <div class="container" id="coupon-code">
        <h class="coupon-discount">Coupon 20% off</h>
        @if($data->booked)

                <div class="code-1">
                </div>
        @else
            <div class="code">
                <span id="coupon-welcome">
                    <p>You Don't Have this Coupon<br>Join Event to get this Coupon</p>
                </span>
                <form action="eventDetails" id="book-icon">
                    <!--img src="http://localhost/build/resources/images/event/icon-appointment-1.png" width="45"
                                                                 height="45"-->
                    <button id="explore"></button>
                </form>
            </div>
        @endif
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
