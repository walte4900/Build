@extends('layouts.app')

@section('content')

</div>
    <div class="cancan">
        <div id="login1">
            <h1>Create your Account</h1>
        </div>
        <div id="login2">
            {!! Form::open(['action' => 'App\Http\Controllers\UserController@store', 'method' => 'POST']) !!}
                {{Form::text('username','',['class' => 'username', 'placeholder' => "Username"])}}
                {{Form::text('email','',['class' => 'email', 'placeholder' => "Email"])}}
                {{Form::password('password', ['class' => 'password2', 'placeholder' => "Password"])}}
                {{Form::submit('Sign on',['class' => 'btn btn-success', 'style' => 'width:100%;'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection