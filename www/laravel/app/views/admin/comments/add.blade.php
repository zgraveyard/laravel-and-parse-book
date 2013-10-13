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
<h2>Add new Comment ( Reply )</h2>
<h4><a href="{{URL::action('AdminCommentsController@getIndex')}}">Back</a></h4>
<div>
    {{Form::open(array('action'=>'AdminCommentsController@postAdd'))}}
    <table>
        <tr>
            <td>Your Name :</td>
            <td>{{Form::text('authorName',null,array('id'=>'authorName','placeholder'=>'Your Name'))}}</td>
        </tr>
        <tr>
            <td>Your Email :</td>
            <td>{{Form::text('authorEmail',Auth::user()->email,array('id'=>'authorEmail','placeholder'=>'Your Email'))}}</td>
        </tr>
        <tr>
            <td>Comment :</td>
            <td>{{Form::textarea('commentBody',null,array('id'=>'commentBody','placeholder'=>'Comment Body'))}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                {{Form::hidden('postId',$postObjectId)}}
                {{Form::submit('Add')}}
            </td>
        </tr>
    </table>
    {{Form::close()}}
</div>
</body>
</html>