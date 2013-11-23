@extends('site.layout')

@section('body')
<div class="row">
    <div class="box">
        <div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center">Jasmine <strong>blog</strong></h2>
            <hr>
        </div>
        @if(!empty($posts))
            @foreach($posts as $post)
            <div class="col-lg-12 text-center">
                <img class="img-responsive img-border img-full" src="http://lorempixel.com/843/403/city/{{rand(1,10)}}">
                <h2>{{$post->title}}<br><small>{{date('Y-M-D',strtotime($post->createdAt))}}</small></h2>
                <p>{{Str::limit($post->body, 255)}}</p>
                <a href="#" class="btn btn-default btn-lg">Read More</a>
                <hr>
            </div>
            @endforeach
        @endif
        <div class="col-lg-12 text-center">
            <ul class="pager">
                <li class="previous"><a href="#">&larr; Older</a></li>
                <li class="next"><a href="#">Newer &rarr;</a></li>
            </ul>
        </div>
    </div>
</div>
@stop