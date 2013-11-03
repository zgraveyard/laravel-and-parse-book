@extends('layout')

@section('body')
<div class="row">
    @if(Session::has('error'))
    <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif
    <div class="col-sm-6 col-md-4 col-md-offset-4">
        <h1 class="text-center login-title">Sign in to continue</h1>
        <div class="account-wall">
            <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                 alt="">
                {{Form::open(array('action'=>'AuthController@postLogin','id'=>'loginForm', 'role'=>'form', 'class'=>'form-signin'))}}

                {{Form::text('email',Input::old('email'),
                array('id'=>'email','placeholder'=>'joe@johndoe.com','class'=>'form-control','required'=>'required')
                )}}
                {{Form::password('password',
                array('id'=>'password','class'=>'form-control','placeholder'=>'password')
                )}}
                {{Form::submit('Login',array('class'=>'btn btn-lg btn-primary btn-block'))}}
                <span class="clearfix"></span>
            {{Form::close()}}
        </div>
    </div>
</div>

@stop