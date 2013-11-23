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
                <h2>{{$post->title}}<br><small>{{date('F j, Y',strtotime($post->createdAt))}}</small></h2>
                <p>{{Str::limit($post->body, 255)}}</p>
                <p class="text-right">
                    <a href="{{URL::action('HomeController@getPost',$post->objectId)}}" class="btn btn-default btn-lg">
                        Read More
                    </a>
                </p>
                <hr>
            </div>
            @endforeach
        @endif
        {{$paginator->links()}}
    </div>
</div>
@stop