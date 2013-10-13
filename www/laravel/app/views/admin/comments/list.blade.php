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
        div.error{color : red}
        div.success {color : green;}
    </style>
</head>
<body>
<h2>All Posts</h2>
@if(Session::has('success'))
<div class="success">{{Session::get('success')}}</div>
@endif

@if(Session::has('error'))
<div class="error">{{Session::get('error')}}</div>
@endif
<h4>Comments List</h4>
<div>
    <table>
        <tr>
            <th>#</th>
            <th>Author</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
        @foreach($items as $item)
        <tr>
            <td>{{$item->objectId}}</td>
            <td>{{$item->authorName}} on <i>{{ $item->post->title }}</i></td>
            <td>{{date('d-M-Y',strtotime($item->createdAt))}}</td>
            <td>
                <a href="{{URL::action('AdminCommentsController@getRecord',$item->objectId)}}">View</a> |
                <a href="{{URL::action('AdminCommentsController@getEdit',$item->objectId)}}">Edit</a> |
                <a href="{{URL::action('AdminCommentsController@getDelete',$item->objectId)}}">Delete</a>
            </td>
        </tr>
        @endforeach
        {{$paginator->links()}}
    </table>
</div>
</body>
</html>