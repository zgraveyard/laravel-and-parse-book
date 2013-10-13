<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>
        div.item{
            display: block;
            margin: 5px;
            overflow : hidden;
        }

        div.item label,
        div.item input{
            width : '50%';
            float: left;
            padding : 5px;
        }
        div.error{color:red;}

    </style>
</head>
<body>
<h2>Login Form</h2>

<div>
    @if(Session::has('error'))
        <div class="error">{{Session::get('error')}}</div>
    @endif
    {{Form::open(array('action'=>'AuthController@postLogin','id'=>'loginForm'))}}
     <div class="item">
         {{Form::label('email','Your Email:')}}
         {{Form::text('email',Input::old('email'),array('id'=>'email','placeholder'=>'joe@johndoe.com'))}}
     </div>
    <div class="item">
        {{Form::label('password','Your Password:')}}
        {{Form::password('password',null,array('id'=>'password'))}}
    </div>
    <div class="item">
        {{Form::submit('login')}}
    </div>
    {{Form::close()}}
</div>
</body>
</html>