<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, viewport-fit=cover initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="http://localhost/build/resources/css/profile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Settings</title>
</head>
<body>
<div class="container">
    <div id = "set" class="row">
        <a href = "{{url('user/profile')}}">
            <img src="http://localhost/build/resources/images/profile/back.png"  ></a>
        <div class="col">Settings</div>
    </div>
    <hr style="height:1px;border:none;border-top:1px solid #555555;" />
    <div class="row">
        <div class="col">Privacy(to be developed)</div>
    </div>
    <hr style="height:1px;border:none;border-top:1px solid #555555;" />
    <div class="row">
        <div class="col">GPS position</div>
        <div class="col">
            <div class="switch-box is-success">
                <input id="default" class="switch-box-input" type="checkbox" />
                <label for="default" class="switch-box-slider"></label>
            </div>
        </div>
    </div>
    <hr style="height:1px;border:none;border-top:1px solid #555555;" />
    <div class="row">
        <div class="col">About</div>
        <div id = "note" class="col">Version 1.0.1</div>
    </div>
    <hr style="height:1px;border:none;border-top:1px solid #555555;" />


    <hr id = "hr" style="height:1px;border:none;border-top:1px solid #555555;" />
    <div id = "logout" class="row">
        <a href="/build/public/user/logout">
            <div class="col">Log out current account</div></a>
    </div>
</div>
</div>

</body>
</html>
<?php
