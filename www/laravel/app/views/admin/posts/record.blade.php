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
        <li class="active">{{$item->title}}</li>
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
                {{$item->title}}</h3>
        </div>
        <div class="panel-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-xs-2 col-md-1">
                            <img src="http://lorempixel.com/80/80/city/{{rand(1,10)}}" class="img-circle img-responsive" alt="" /></div>
                        <div class="col-xs-10 col-md-11">
                            <div>
                                <div class="mic-info">
                                    on {{date('d-M-Y',strtotime($item->createdAt))}}
                                </div>
                            </div>
                            <div class="comment-text">
                                {{nl2br($item->body)}}
                            </div>
                            <div class="action">
                                <a class="btn btn-primary btn-xs" title="Edit" href="{{URL::action('AdminPostsController@getEdit',$item->objectId)}}">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                @if($item->active)
                                <a class="btn btn-success btn-xs" title="Published" href="{{URL::action('AdminPostsController@getHide',$item->objectId)}}">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </a>
                                @else
                                <a class="btn btn-danger btn-xs" title="Un-Publish" href="{{URL::action('AdminPostsController@getPublish',$item->objectId)}}">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                                @endif
                                <a class="btn btn-danger btn-xs" title="Delete" href="{{URL::action('AdminPostsController@getDelete',$item->objectId)}}">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                                <a class="btn btn-primary btn-xs" title="View Post Comments" href="{{URL::action('AdminCommentsController@getPostComments',$item->objectId)}}">
                                    <span class="glyphicon glyphicon-comment"></span>
                                </a>

                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@stop