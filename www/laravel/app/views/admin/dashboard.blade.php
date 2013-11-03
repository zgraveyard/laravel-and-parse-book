@extends('layout')

@section('body')
<div class="row" id="dashboard">
    <div class="col-sm-6 col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-bookmark"></span> Quick Shortcuts</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <a href="{{URL::action('AdminPostsController@getIndex')}}" class="btn btn-danger btn-lg" role="button">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            <br/>Posts
                        </a>
                        <a href="{{URL::action('AdminCommentsController@getIndex')}}" class="btn btn-primary btn-lg" role="button">
                            <span class="glyphicon glyphicon-comment"></span>
                            <br/>Comments
                        </a>
                    </div>
                    <div class="col-xs-6 col-md-6">
                        <a href="#" class="btn btn-success btn-lg" role="button">
                            <span class="glyphicon glyphicon-user"></span>
                            <br/>Users
                        </a>
                        <a href="{{URL::route('logout')}}" class="btn btn-primary btn-lg" role="button">
                            <span class="glyphicon glyphicon-signal"></span>
                            <br/>Logout
                        </a>
                    </div>
                </div>
                <a href="http://www.jquery2dotnet.com/" class="btn btn-success btn-lg btn-block" role="button">
                    <span class="glyphicon glyphicon-globe"></span>
                    Website
                </a>
            </div>
        </div>
    </div>
</div>
@stop