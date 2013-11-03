@extends('layout')

@section('body')
<div class="row">

    @if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif

    @if(Session::has('error'))
    <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif

    <ol class="breadcrumb">
        <li><a href="{{URL::action('AdminDashboardController@getIndex')}}">Home</a></li>
        <li><a href="{{URL::action('AdminCommentsController@getIndex')}}">ALL Comments</a></li>
        <li class="active">Add New Reply</li>
        <li class="pull-right no-before">
            <a href="{{URL::route('logout')}}">
                Logout
            </a>
        </li>
    </ol>
    <div class="panel panel-default widget">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-list-alt"></span>
            <h3 class="panel-title">
                Add New Post</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('action'=>'AdminCommentsController@postAdd', 'role'=>'form'))}}
            <div class="form-group">
                {{Form::label('authorName','Your Name :')}}
                {{Form::text('authorName',null,array('id'=>'authorName','placeholder'=>'Your Name', 'class'=>'form-control', 'required'=>'required'))}}
            </div>
            <div class="form-group">
                {{Form::label('authorEmail','Your Email :')}}
                {{Form::text('authorEmail',Auth::user()->email,array('id'=>'authorEmail','placeholder'=>'Your Email', 'class'=>'form-control', 'required'=>'required'))}}
            </div>
            <div class="form-group">
                {{Form::label('commentBody','Comment :')}}
                {{Form::textarea('commentBody',null,array('id'=>'commentBody','placeholder'=>'Comment Body', 'class'=>'form-control', 'required'=>'required'))}}
            </div>
            {{Form::hidden('postId',$postObjectId)}}
            {{Form::submit('Reply',array('class'=>'btn btn-primary'))}}
            {{Form::close()}}
        </div>
    </div>
</div>
@stop