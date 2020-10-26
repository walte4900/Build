<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- font，customized style & boostrap style -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Playball&family=Source+Sans+Pro&display=swap" rel="stylesheet">
{{--    <link rel="stylesheet" href="../resources/css/style.css">--}}
    {{-- <link rel="stylesheet" href="../resources/css/style.css"> --}}
    <link rel="stylesheet" href="http://localhost/build/resources/css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    {{-- js --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    {{-- <script src="../resources/js/jquery-3.5.0.min.js"></script> --}}

    <title>Green Tourism</title>
</head>

<body id="all">
    @include('inc.message')
    @yield('content')

    <footer class="footer">
        <ul class="icons" style="margin-top: 1px;">
            <li><a href="{{url("/")}}"><img src="http://localhost/build/resources/images/Home.png" id="home-icon"></a></li>
            <li><a href="{{url("/map")}}"><img src="http://localhost/build/resources/images/maps.png" id="maps-icon"></a></li>
            <a href="{{url("user/post_page")}}"><li><div id="camera-icon" style="box-sizing:content-box;"></div></li></a>
            <li><a href="{{url("/favourite")}}"><img src="http://localhost/build/resources/images/favorite-icon.png" id="favorite-icon"></a></li>
            <li><a href="{{url("user/profile")}}"><img src="http://localhost/build/resources/images/person-1.png" id="person-icon"></a></li>
        </ul>
    </footer>

</body>
