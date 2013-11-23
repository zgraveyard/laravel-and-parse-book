@extends('site.layout')

@section('body')
<div class="row">
    <div class="box">
        <div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center">
                {{$post->title}}<br />
                <small>{{date('F j, Y',strtotime($post->createdAt))}}</small>
            </h2>
            <hr>
        </div>
        <div class="col-lg-12">
            <img class="img-responsive img-border img-full" src="http://lorempixel.com/843/403/city/{{rand(1,10)}}">
            <p class="text-justify">{{nl2br($post->body)}}</p>
            @if(!empty($comments))
            <hr />
            <h3>Comments :</h3>
                @foreach($comments as $comment)
                <div id="comments">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Name</label>
                            {{$comment->authorName}}
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-lg-12">
                            <label>Message</label>
                            {{nl2br($comment->commentBody)}}
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
            <hr>
            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            <h3>Add Comment:</h3>
            {{Form::open(array('action'=>'HomeController@postAddComment', 'role'=>'form'))}}
            <div class="row">
                <div class="form-group col-lg-6">
                    <label>Name</label>
                    {{Form::text('authorName',Input::old('authorName'),array('class'=>'form-control','required'=>'required'))}}
                </div>
                <div class="form-group col-lg-6">
                    <label>Email Address</label>
                    {{Form::email('authorEmail',Input::old('authorEmail'),array('class'=>'form-control','required'=>'required'))}}
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-lg-12">
                    <label>Message</label>
                    {{Form::textarea('commentBody',Input::old('commentBody'),array('class'=>'form-control','required'=>'required','rows'=>'6'))}}
                </div>
                <div class="form-group col-lg-12">
                    {{Form::hidden('postId',$post->objectId)}}
                    {{Form::submit('Submit',array('class'=>'btn btn-default'))}}
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
@stop