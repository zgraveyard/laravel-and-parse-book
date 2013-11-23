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
            <li class="active">Posts Comments</li>
            <li class="pull-right no-before">
                <a href="{{URL::route('logout')}}">
                    Logout
                </a>
            </li>
        </ol>

        <div class="panel panel-default widget">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-comment"></span>
                <h3 class="panel-title">
                    Posts Comments</h3>
                <span class="label label-info">
                    {{$total}}</span>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    @foreach($items as $item)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-1">
                                <img src="http://lorempixel.com/80/80/people/{{rand(1,10)}}" class="img-circle img-responsive" alt="" /></div>
                            <div class="col-xs-10 col-md-11">
                                <div>
                                    <a href="{{URL::action('AdminCommentsController@getRecord',$item->objectId)}}">
                                        Comment on {{ $item->post->title }}</a>
                                    <div class="mic-info">
                                        By: <a href="{{URL::action('AdminCommentsController@getRecord',$item->objectId)}}">{{$item->authorName}}</a>
                                        on {{date('d-M-Y',strtotime($item->createdAt))}}
                                    </div>
                                </div>
                                <div class="comment-text">
                                    {{$item->commentBody}}
                                </div>
                                <div class="action">
                                    <a class="btn btn-primary btn-xs" title="View" href="{{URL::action('AdminCommentsController@getRecord',$item->objectId)}}">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                    @if(!$item->approved)
                                    <a class="btn btn-success btn-xs" title="Approved" href="{{URL::action('AdminCommentsController@getHide',$item->objectId)}}">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </a>
                                    @else
                                    <a class="btn btn-danger btn-xs" title="Un Approve" href="{{URL::action('AdminCommentsController@getPublish',$item->objectId)}}">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{$paginator->links()}}
    </div>
@stop