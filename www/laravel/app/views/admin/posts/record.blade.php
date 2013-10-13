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
<h2>{{$item->title}}</h2>
@if(Session::has('success'))
    {{Session::get('success')}}
@endif
<div>
    <div class="item">
        <label>Title :</label>
        <p>{{$item->title}}</p>
    </div>
    <div class="item">
        <label>Body :</label>
        <p>{{$item->body}}</p>
    </div>
    <div class="item">
        <label>Status :</label>
        <p>
        @if($item->active)
            Active
        @else
            In Active
        @endif
        </p>
    </div>
    <div class="item">
        <label>Added Date :</label>
        <p>{{date('d - M - Y',strtotime($item->createdAt))}}</p>
    </div>
</div>
</body>
</html>