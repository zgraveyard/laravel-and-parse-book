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

    {{Form::open(array('action'=>'AdminCommentsController@postEdit'))}}
    <table>
        <tr>
            <td>Author Name :</td>
            <td>{{Form::text('authorName',$item->authorName,array('id'=>'authorName','placeholder'=>'Your Name'))}}</td>
        </tr>
        <tr>
            <td>Author Email :</td>
            <td>{{Form::text('authorEmail',$item->authorEmail,array('id'=>'authorEmail','placeholder'=>'Your Email'))}}</td>
        </tr>
        <tr>
            <td>Comment :</td>
            <td>{{Form::textarea('commentBody',$item->commentBody,array('id'=>'commentBody','placeholder'=>'Comment Body'))}}</td>
        </tr>
        <tr>
            <td>Approved :</td>
            <td>{{Form::select('approved',array('1'=>'Approved','0'=>'Waiting Approval'),$item->approved,array('id'=>'commentBody','placeholder'=>'Comment Body'))}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                {{Form::hidden('postsId',$item->post->objectId)}}
                {{Form::hidden('objectId',$item->objectId)}}
                {{Form::submit('Update')}}
            </td>
        </tr>
    </table>
    {{Form::close()}}
</div>
</body>
</html>