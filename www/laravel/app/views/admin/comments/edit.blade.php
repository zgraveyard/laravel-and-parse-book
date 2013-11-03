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
        <li><a href="{{URL::action('AdminCommentsController@getIndex')}}">ALL Comments</a></li>
        <li class="active">Edit Comment</li>
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
                Edit Comment</h3>
        </div>
        <div class="panel-body">
            {{Form::open(array('action'=>'AdminCommentsController@postEdit', 'role'=>'form'))}}
            <div class="form-group">
                {{Form::label('authorName','Your Name :')}}
                {{Form::text('authorName',$item->authorName,array('id'=>'authorName','placeholder'=>'Your Name', 'class'=>'form-control', 'required'=>'required'))}}
            </div>
            <div class="form-group">
                {{Form::label('authorEmail','Your Email :')}}
                {{Form::text('authorEmail',$item->authorEmail,array('id'=>'authorEmail','placeholder'=>'Your Email', 'class'=>'form-control', 'required'=>'required'))}}
            </div>
            <div class="form-group">
                {{Form::label('commentBody','Comment :')}}
                {{Form::textarea('commentBody',$item->commentBody,array('id'=>'commentBody','placeholder'=>'Comment Body', 'class'=>'form-control', 'required'=>'required'))}}
            </div>
            <div class="form-group">
                {{Form::label('approved','Approved :')}}
                {{Form::select('approved',array('1'=>'Approved','0'=>'Waiting Approval'),$item->approved,array('id'=>'approved','class'=>'form-control'))}}
            </div>
            {{Form::hidden('postsId',$item->post->objectId)}}
            {{Form::hidden('objectId',$item->objectId)}}
            {{Form::submit('Reply',array('class'=>'btn btn-primary'))}}
            {{Form::close()}}
        </div>
    </div>
</div>
@stop