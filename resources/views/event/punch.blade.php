<!DOCTYPE html>
<html lang="en">

<head>
    <title>Punch!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <a class="back2" href="">
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
    <div class="container ">
        <div class="card" width=375>
            <a class="logo" href=""><img src="http://localhost/build/resources/images/event/icons8-national-park-50.png"
                                         alt="Card image" width=50
                                         height=50></a>
            @if(!$info->can)
            <img class="punching" src="http://localhost/build/resources/images/event/clock-in-icon.png"
                 alt="Card image" width=50 height=50>
            @else
            <img class="punching" src="http://localhost/build/resources/images/event/clock in icon-grey.png"
                 alt="Card image" width=50 height=50>
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
                    <div class="address"><p>{{$location}}</p></div>
                </div>
                <div class="daka">
                    <a class="in-punch-in" style="text-decoration: none;">
                        <form  class="punch-in">
                            <p>Punch in </p>
                        </form>
                    </a>
                    <p class="punch-in-hint in-punch-in">Please punch in within 100 <br>
                        meters of the event</p>
                </div>

                <div class="4punch">
                    <div class="event-intro punch-in-hide 4punch">
                        <p>{{$first_para}}<br>{{$second_para}}</p>
                        <div id="gradient" class="punch-in-hide"></div>
                    </div>
                    <div id="read-more" class="punch-in-hide"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container 4punch" id="comments">
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
    <div class = '4punch' id="div-body">
        <div class="comment-input">
            <button type="button" class="btn btn-primary btn-block comment-button" id="commentEvent">
                <img src="http://localhost/build/resources/images/event/comment-dots.png" width=28 height=28>
                <p>Comment</p>
            </button>
        </div>
    </div>

    <div class="bookInfo" id="confirm-punch-in" >
        <h>Got a Coupon!</h>
        <p>You have succussfully punch in<br>
            and get a coupon!<br>
            Would you like to check it? </p>
        <form action="/build/public/punchInStay/{{$eid}}" class="button-no">
            <button class="confirm-button">No</button>
        </form>
        <form action="/build/public/punchInGo/{{$eid}}" class="button-sure">
            <button class="confirm-button" id="yes">Sure</button>
        </form>

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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoCaB9U_hB6RiBh1IONqTKj4ML8t1qsUs&language=en&libraries=geometry" rel="external nofollow " ></script>
<script>
    let latitude = null
    let longitude = null;
    var timestamp = new Date().getTime();
    getLocation();
    function getLocation(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successFunction);
        }

        //Get the latitude and the longitude;
        function successFunction(position) {
            latitude = position.coords.latitude;
            longitude = position.coords.longitude;;
            let p1 = new google.maps.LatLng(latitude, longitude);
            let p2 = new google.maps.LatLng({{$lati}}, {{$longi}});
            calcDistance(p1, p2);

            function calcDistance(p1, p2) {
                let d = (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
                let punch = document.getElementsByClassName('4punch');
                let daka = document.getElementsByClassName('daka');
                // console.log(d<=0.1);
                if(d<=3 && timestamp >= {{$start_date}} && timestamp >= {{$end_date}} && {{$info->can}}){
                    for(let i=0; i<punch.length; i++){
                        punch[i].style.display = 'none';
                        console.log(punch[i]);
                    }
                    for(let i=0; i<daka.length; i++){
                        daka[i].style.display = 'block';
                    }
                }else {
                    for(let i=0; i<punch.length; i++){
                        punch[i].style.display = 'block';
                    }
                    for(let i=0; i<daka.length; i++){
                        daka[i].style.display = 'none';
                    }
                }

            }
        }
    }
</script>

</html>
<?php
