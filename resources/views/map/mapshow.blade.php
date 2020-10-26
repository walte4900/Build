@extends('layouts.app')

@section('content')
{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<style>--}}
{{--    html, body {--}}
{{--        height: 100%;--}}
{{--    }--}}
{{--</style>--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Map</title>--}}

    <script src="http://localhost/build/resources/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoCaB9U_hB6RiBh1IONqTKj4ML8t1qsUs&language=en"
        rel="external nofollow "></script>
    <script>
        // initiate mapAttribute
        var map, inforWindow, positionMarker, pos;
        {{--var nonCoupEvent = {{$nonCoupon_data}};--}}
        // var nonCoupEvent = [
        //     ['http://www.google.com/', -27.503050,153.005548, 4],
        //     ['http://www.google.com/', -27.492852,153.001465, 4],
        //     ['http://www.google.com/', -27.494804,152.996101, 4],
        // ];
        //
        // var coupEvent = [
        //     ['xxx', -27.501505, 153.011538, 4],
        //     ['xxx', -27.505313, 153.017670, 4],
        // ];


        function initialize() {
            var mapProp = {
                // building 49 uq
                center: new google.maps.LatLng(-27.499300, 153.015176),
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true
            };
            map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(function (position) {
                    //user current position
                     pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(pos);

                    if (positionMarker) {
                        positionMarker.setPosition(pos);
                    } else {
                        positionMarker = new google.maps.Marker({
                            position: pos,
                            map: map,
                            animation: google.maps.Animation.BOUNCE,
                            icon: 'http://localhost/build/resources/images/map/target.png',
                        });
                    }
                });
            }
            setMarker(map);
        };

        function setMarker(map) {
            //添加 nonCoupEvent  CoupEvent  Event Marker
            var marker, marker1;
            infoWindow = new google.maps.InfoWindow;
            @foreach($db_coupon as $key=>$value)
                console.log({{$value->longitude}});
                console.log('{{$value->href}}' );
                marker_{{$value->eid}} = new google.maps.Marker({
                        position: new google.maps.LatLng({{$value->latitude}},{{$value->longitude}}),
                        url: '{{$value->href}}',
                        map: map,
                        icon: 'http://localhost/build/resources/images/map/coupon-3.png',
                    });
                    google.maps.event.addListener(marker_{{$value->eid}}, 'click', function () {

                        window.location.href = marker_{{$value->eid}}.url;
                    });
            @endforeach

            @foreach($db_nonCoupon as $key=>$value)
                console.log("---------------------")
                {{--console.log('{{$value->href}}' );--}}
                    marker{{$value->eid}} = new google.maps.Marker({
                    position: new google.maps.LatLng({{$value->latitude}},{{$value->longitude}}),
                    url: '{{$value->href}}',
                    map: map,
                    icon: 'http://localhost/build/resources/images/map/icon-appointment-1.png',
                    });
                    google.maps.event.addListener(marker{{$value->eid}}, 'click', function () {
                        console.log(marker{{$value->eid}}.url);
                        window.location.href = marker{{$value->eid}}.url;
                    });
            @endforeach
        };
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body>
<div class="container" id="googleMap" style="width:100%; height: 100%;"></div>
</body>
</html>
@endsection

