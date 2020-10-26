<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Green Tourism coupon list</title>
</head>
<body>
<nav class="navbar">
    <a class="back2" href="{{url("user/profile")}}">
        <img src="http://localhost/build/resources/images/profile/back.png" height=40 width=40>
    </a>
    <h6>My Coupons</h6>
    <button class="btn btn-danger">Obtain</button>
</nav>
    @if(count($coupons) == 0)
    <h2>You don't have any Coupon :(</h2>
    @else
        @foreach($coupons as $key=>$value)
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <button class="btn btn-outline-secondary use_coupon" style="float: right;" id="coupon_{{$value[0]->cid}}">Use</button>
                    <p class="card-title text-danger font-weight-bold">{{$value[0]->title}}</p>
                    <p class="card-title font-weight-bold">{{$value[0]->title}}</p>
                    <p class="card-text text-muted" style="font-size:13px;">Expire at {{$value[0]->expire}}. All rights are reserved by green tourism, please contact us if you have any problems</p>
                </div>
            </div>
        @endforeach
    @endif
<script src="http://localhost/build/resources/js/jquery-3.5.0.min.js"></script>
<script>
    $(".use_coupon").click(function(){
        let div_id = this.getAttribute("id");
        let coupon_id = parseInt(this.getAttribute("id").substring(7));
        window.location.href = 'http://localhost/build/public/couponDetail/'+coupon_id;
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //     type: 'POST',
        //     dataType:'json',
        //     data: {
        //         "coupon_id": coupon_id,
        //         _token: $('meta[name="csrf-token"]').attr('content')
        //
        //     },
        //     url: "use_coupon",
        //     success:function(data){
        //         alert("Use coupon succesfully")
        //
        //     },
        // });
    });
</script>
</body>
<?php
