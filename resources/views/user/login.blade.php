@extends('layouts.app')

@section('content')
<div class="containner-2">
        <div class="col-2" >
        <img src="../resources/images/icon2-1 - Copy.png" class="img-responsive" alt="Green Tourism Brand Icon" style="margin-left: 90px;">
        <h1 style="margin-left: 95px;">Green Tourism</h1>
        </div>
    </div>
    <div class="cancan">
    <div id="login1">
        <h1>Login to your Account</h1>
    </div>
    <div id="login1-1">
    {!! Form::open(['action' => 'App\Http\Controllers\UserController@login', 'method' => 'POST']) !!}
        {{Form::text('email','',['class' => 'email', 'placeholder' => "Email"])}}
        {{Form::password('password', ['class' => 'password2', 'placeholder' => "Password"])}}
        {{Form::submit('Sign In',['class' => 'btn btn-success', 'style' => 'width:100%;'])}}
    {!! Form::close() !!}

        {{-- <form action="">
            <input type="text" id="email" name="email" placeholder="Email">
            <input type="password" id="password" name="password" placeholder="Password">
            <input type="button" class="btn btn-success" style="width:100%;" value="Sign in">
          </form> --}}
    </div>


    <div id="login1-2">
        <ul id="and">
          <li>Don't have an account?  &nbsp</li>
          <li id="signon-colour"><a href="/build/public/logon">Sign on </a></li>
        </ul>

    </div>
</div>
<div style="height:70px;"></div>
@endsection