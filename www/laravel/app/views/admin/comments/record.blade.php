<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>
        div.item{
            display: block;
            margin: 5px;
            overflow : hidden;
        }
        div.item label{
            display: block;
            font-weight: bold;
        }

        div.item p{
            border-bottom : 1px dashed #ccc;
            margin-bottom: 2px;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
<h2>Comment on `{{$item->post->title}}`</h2>
@if(Session::has('success'))
{{Session::get('success')}}
@endif
<div>
    <div class="item">
        <label>Comment on Post :</label>
        <p>
            <a href="{{URL::action('AdminPostsController@getRecord',$item->post->objectId)}}">
                {{$item->post->title}}
            </a>
        </p>
    </div>
    <div class="item">
        <label>Comment Author :</label>
        <p>{{$item->authorName}}</p>
    </div>
    <div class="item">
        <label>Comment Author Email :</label>
        <p>
            <a href="mailto:{{$item->authorEmail}}">
                {{$item->authorEmail}}
            </a>
        </p>
    </div>
    <div>
        <label>Comment :</label>
        <p>{{$item->commentBody}}</p>
    </div>
    <div class="item">
        <label>Added Date :</label>
        <p>{{date('d - M - Y',strtotime($item->createdAt))}}</p>
    </div>
</div>
</body>
</html>