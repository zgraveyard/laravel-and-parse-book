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
<h2>Add new Post</h2>
<h4><a href="{{URL::action('AdminPostsController@getIndex')}}">Back</a></h4>
<div>
    {{Form::open(array('action'=>'AdminPostsController@postEdit'))}}
    <table>
        <tr>
            <td>Title :</td>
            <td>{{Form::text('title',$item->title,array('id'=>'title','placeholder'=>'Post Title'))}}</td>
        </tr>
        <tr>
            <td>Body :</td>
            <td>{{Form::textarea('body',$item->body,array('id'=>'body','placeholder'=>'Post Body'))}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                {{Form::hidden('objectId',$item->objectId)}}
                {{Form::submit('update')}}
            </td>
        </tr>
    </table>
    {{Form::close()}}
</div>
</body>
</html>