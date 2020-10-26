{{-- <!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

@extends('layouts.app')

@section('content')
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Playball&family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resources/css/favourite.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    {{-- <title>Green Tourism Homepage</title> --}}
</head>
<body class="homepage">
<section class="wrapper">
    <nav class="navbar" style="display:inline;">
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width:70%; margin-left:15px;">
            <a href="{{url("/user/coupon")}}"><img id="coupon-2" src="../resources/images/coupon-2.png" style="margin-top: 0px;"></a>
        </form>
    </nav>


    {{-- <div class="homenav">
        <div class="box1">
            <i><img src="../resources/images/search.png"></i>
            <input type="text" placeholder="Search">
        </div>
        <a><img id="coupon-2" src="../resources/images/coupon-2.png"></a>
    </div> --}}
    <!--<div class="search-position">
        <img src="images/GPS icon.png">
        <h1>Brisbane</h1>
    </div>   -->
{{--    <div class="dropdown-click">--}}
{{--        <button onclick="sortedBy()" class="sort-button left_sort_button" id="event">Sort by Events</button>--}}
{{--        <div id="showing" class="sort-dropdown-content">--}}
{{--            <p style="color:grey" id="select_publisher">Publishers</p>--}}
{{--            <p id="select_events">Events</p>--}}
{{--            <p style="color:grey" id="select_both">Both</p>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="blog">
        @if(count(array($data)) == 0)
            <h5>Have a look by casual :)</h5>
        @else

            @foreach($data as $value)
                @if ($value->type == 'eid' and $value->today == 'yes')
                    {{-- <div id="blog-3" value="{{$value->type}}\{{$value->id}}" class="blog-3"> --}}

                        {{-- <div id="blog-3-img">
                            <img src="../resources/images/icons8-national-park-50.png" class="author_icon">
                            <img src="../resources/images/event/clock-in-icon.png" class="right_corner_icon clock_icon"/>
                            <img src="../resources/images/iconfinder_pin_299069.png" class="pin_icon"/>
                            <div class="stars_rating">
                                <img src="../resources/images/star.png" class="star_icon"/>
                                <img src="../resources/images/star.png" class="star_icon"/>
                                <img src="../resources/images/star.png" class="star_icon"/>
                                <img src="../resources/images/star.png" class="star_icon"/>
                                <span class="rate_score">4.8</span>
                            </div>
                        </div>
                        <div id="blog-3-words">
                            <h1>{{$value->title}}</h1>
                            <span class="d-inline-block text-truncate text-muted" style="max-width: 100%;">{{$value->first_para}}</span>
                        </div> --}}
                    {{-- </div> --}}
                    <div class="card punch_card" style="width: 94%; margin: 0px 10px; border-radius: 15px; border: 2px solid #F5F1F2" value="{{$value->type}}\{{$value->id}}">
                        <img src="{{$value->cover_img}}" class="card-img-top" style="border-radius: 15px 15px 0px 0px; height:200px" >
                        <img src="../resources/images/icons8-national-park-50.png" class="author_icon">
                        <img src="../resources/images/iconfinder_pin_299069.png" class="pin_icon"/>
                        <img src="../resources/images/event/clock-in-icon.png" class="right_corner_icon clock_icon"/>
                        <div class="stars_rating" style="z-index:999; display:flex;">
                            <img src="../resources/images/star.png" class="star_icon"/>
                            <img src="../resources/images/star.png" class="star_icon"/>
                            <img src="../resources/images/star.png" class="star_icon"/>
                            <img src="../resources/images/star.png" class="star_icon"/>
                            <span class="rate_score">4.8</span>
                        </div>
                        <div class="card-body" style="padding: 10px;">
                        <h6 class="card-title">{{$value->title}}</h6>
                        <span class="d-inline-block text-truncate text-muted" style="max-width: 100%;">{{$value->first_para}}</span>
                    </div>
                    </a>
                    </div>
                    <div style="height:20px;weight:100%;"></div>
                @else
                    @if ($value->type == 'pid')
                        {{-- <div id="blog-4" value="{{$value->type}}\{{$value->id}}" class="blog-4">
                            <div id="blog-4-img" style="background-image: url({{$value->cover_img}}); background-size: 100% 100%; ">
                                <img src="{{$value->cover_img}}" style="background-size:100% 100%">
                                <img src="../resources/images/koala park.jpeg" class="author_icon" >
                                <img src="../resources/images/event/Facebook-Heart.png" class="right_corner_icon" >
                                <div class="stars_rating" >
                                    <img src="../resources/images/star.png" class="star_icon"/>
                                    <img src="../resources/images/star.png" class="star_icon"/>
                                    <img src="../resources/images/star.png" class="star_icon"/>
                                    <img src="../resources/images/star.png" class="star_icon"/>
                                    <span class="rate_score">4.8</span>
                                </div>
                            </div>
                            <div id="blog-4-words">
                                <h1>{{$value->title}}</h1>
                                <span class="d-inline-block text-truncate text-muted" style="max-width: 100%;">{{$value->detail}}</span>
                            </div>
                        </div> --}}
                        <div class="card nopunch_card" style="width: 94%; margin: 0px 10px; border-radius: 15px; border: 2px solid #F5F1F2" value="{{$value->type}}\{{$value->id}}">
                            <img src="{{$value->cover_img}}" class="card-img-top" style="border-radius: 15px 15px 0px 0px; height:200px">
                            <img src="../resources/images/koala park.jpeg" class="author_icon" style="z-index:999;">
                            <img src="../resources/images/event/Facebook-Heart.png" class="right_corner_icon" style="z-index:999;">
                            <div class="stars_rating" style="z-index:999; display:flex;">
                                <img src="../resources/images/star.png" class="star_icon"/>
                                <img src="../resources/images/star.png" class="star_icon"/>
                                <img src="../resources/images/star.png" class="star_icon"/>
                                <img src="../resources/images/star.png" class="star_icon"/>
                                <span class="rate_score" style="color: white; float:left; ">4.8</span>
                            </div>
                            <div class="card-body" style="padding: 10px;">
                                <h6 class="card-title">{{$value->title}}</h6>
                                <span class="d-inline-block text-truncate text-muted" style="max-width: 100%;">{{$value->detail}}</span>
                            </div>
                            </a>
                        </div>
                        <div style="height:20px;weight:100%;"></div>
                    @endif
                @endif
            @endforeach
        @endif
        <div id="margin-giv"></div>
    </div>
</section>
{{-- <footer class="footer">
    <ul class="icons">
        <li><img src="../resources/images/home-icon-silhouette.png" id="home-icon"></li>
        <li><img src="../resources/images/maps.png" id="maps-icon"></li>
        <!-- <li><img src="images/camera2.png" id="camera-icon"></li> -->
        <li><div id="camera-icon"></div></li>
        <li><img src="../resources/images/favorite-icon.png" id="favorite-icon"></li>
        <li><img src="../resources/images/person-1.png" id="person-icon"></li>
    </ul>
</footer> --}}
<script src="http://localhost/build/resources/js/jquery-3.5.0.min.js"></script>
<script>

    $(".punch_card").click(function(){
        // console.log("kkkkk");
        let id = this.getAttribute("value").split("\\")[1];
        console.log(id);
        window.location.href = "http://localhost/build/public/punch/" + id;
    });
    function sortedBy() {
        document.getElementById("showing").classList.toggle("show");

        window.onclick = function (event) {
            if (!event.target.matches('.sort-button')) {
                var dropdowns = document.getElementsByClassName("sort-dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    }
    $(".nopunch_card").click(function(){
        // console.log("kkkkk");
        let which_id = this.getAttribute("value").split("\\")[0];
        let id = this.getAttribute("value").split("\\")[1];
        console.log(id);
        if(which_id === "eid"){
            window.location.href = "http://localhost/build/public/eventDetails/" + id;
        }else{
            window.location.href = "http://localhost/build/public/postDetails/" + id;
        }
    });
    // $("#blog-3").click(function(){
    //     let eid = parseInt(this.getAttribute("value"));
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         type: 'POST',
    //         dataType:'json',
    //         data: {
    //             "eid": eid,
    //             _token: $('meta[name="csrf-token"]').attr('content')
    //
    //         },
    //         url: "eventDetails",
    //         success:function(data){
    //             // console.log(data[0].detail);
    //
    //         },
    //     });
    // })
</script>

@endsection
