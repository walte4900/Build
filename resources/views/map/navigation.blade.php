@extends('layouts.app')

@section('content')

<!-- https://blog.csdn.net/cplvfx/article/details/75009590 -->

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoCaB9U_hB6RiBh1IONqTKj4ML8t1qsUs&language=en"
        rel="external nofollow "></script>

</head>

<body>
<div class="container" id="googleMap" style="width:100%; height: 100%;"></div>
</body>

<script>
    // 需要替换自动定位的位置
    // currentPosition = {
    //     lat: -27.496499,
    //     lng: 153.013640,
    // };
    var currentPosition, map, directionsService, icons, request;
    function init() {
        directionsService = new google.maps.DirectionsService();
        var mapProp = {
            zoom: 20,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        icons = {
            start: new google.maps.MarkerImage(
                // URL
                'http://localhost/build/resources/images/map/target.png',
            ),
            end: new google.maps.MarkerImage(
                // URL
                'http://localhost/build/resources/images/map/icon-appointment-1.png',
            )
        };
        getPosition();
    };


    // getPosition(currentPosition);
    function getPosition(currentPosition) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                //user current position
                currentPosition = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                navigation(currentPosition);
            });
        }
        ;
    };

    function navigation(currentPosition) {
        console.log(currentPosition);
        map.setCenter(currentPosition);
        console.log("------");
        console.log({{$latitude}});
        request = {
            origin: currentPosition,
            destination: {lat: {{$latitude}}, lng: {{$longitude}}},
            travelMode: 'WALKING',
        };
        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                // directionsDisplay.setDirections(response);
                new google.maps.DirectionsRenderer({
                    map: map,
                    directions: response,
                    suppressMarkers: true
                });
                var leg = response.routes[0].legs[0];
                makeMarker(leg.start_location, icons.start, "title");
                makeMarker(leg.end_location, icons.end, 'title');
            }
        });
    };


    function makeMarker(position, icon, title) {
        new google.maps.Marker({
            position: position,
            map: map,
            icon: icon,
            title: title
        });
    };

    init();

</script>

@endsection
