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
        <li class="active">ALL Posts</li>
        <li class="pull-right no-before">
            <a href="{{URL::route('logout')}}">
                Logout
            </a>
        </li>
    </ol>
        <div class="add-new center-block">
            <a class="btn btn-default btn-sm" title="Add new Post" href="{{URL::action('AdminPostsController@getAdd')}}">
                <span class="glyphicon glyphicon-plus-sign"></span> Add new Post
            </a>
        </div>
    <div class="clearfix"></div>
    <br />
    <div class="panel panel-default widget">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-list-alt"></span>
            <h3 class="panel-title">
                All Posts</h3>
                <span class="label label-info">
                    {{$total}}</span>
        </div>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($items as $item)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-xs-2 col-md-1">
                            <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                        <div class="col-xs-10 col-md-11">
                            <div>
                                <a href="{{URL::action('AdminPostsController@getRecord',$item->objectId)}}">
                                    {{$item->title}}</a>
                                <div class="mic-info">
                                    on {{date('d-M-Y',strtotime($item->createdAt))}}
                                </div>
                            </div>
                            <div class="comment-text">
                                {{Str::limit($item->body, 50)}}
                            </div>
                            <div class="action">
                                <a class="btn btn-primary btn-xs" title="View" href="{{URL::action('AdminPostsController@getRecord',$item->objectId)}}">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                                @if(!$item->active)
                                <a class="btn btn-success btn-xs" title="Published" href="#">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </a>
                                @else
                                <a class="btn btn-danger btn-xs" title="hidden" href="#">
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