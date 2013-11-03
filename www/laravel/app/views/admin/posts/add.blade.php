@extends('admin.layout')

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
        <li><a href="{{URL::action('AdminPostsController@getIndex')}}">ALL Posts</a></li>
        <li class="active">Add New Post</li>
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
            {{Form::open(array('action'=>'AdminPostsController@postAdd', 'role'=>'form'))}}
            <div class="form-group">
                {{Form::label('title','Title :')}}
                {{Form::text('title',null,array('id'=>'title','placeholder'=>'Post Title', 'class'=>'form-control', 'required'=>'required'))}}
            </div>
            <div class="form-group">
                {{Form::label('body','Body :')}}
                {{Form::textarea('body',null,array('id'=>'body','placeholder'=>'Post Body', 'class'=>'form-control', 'required'=>'required'))}}
            </div>
                {{Form::submit('Create',array('class'=>'btn btn-primary'))}}
                {{Form::close()}}
        </div>
    </div>
</div>
@stop