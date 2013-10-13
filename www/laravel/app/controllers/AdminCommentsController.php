<?php

class AdminCommentsController extends BaseController{

    public function getIndex()
    {
        try{
            $fullComments = new parseQuery('comments');
            $fullComments->setCount(true);
            //this is the important field, which also get the post data
            $fullComments->whereInclude('post');
            $comments = $fullComments->find();



            $paginator = Paginator::make($comments->results, $comments->count, 10);

            $data = array(
                'items'=> $comments->results,
                'paginator' => $paginator
            );

            return View::make('admin.comments.list')->with($data);

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getEdit($objectId = null)
    {
        try{
            if(is_null($objectId)){
                return Redirect::action('AdminCommentsController@getIndex')->with('error','Choose a comment to edit');
            }

            $commentRecord = new parseQuery('comments');
            $commentRecord->where('objectId', $objectId);
            $commentRecord->whereInclude('post');
            $commentRecord->setLimit(1);
            $result = $commentRecord->find();
            $result->results[0]->approved = ($result->results[0]->approved) ? 1 : 0;
            $data = array(
                'item'=> $result->results[0],
            );

            return View::make('admin.comments.edit')->with($data);


        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function postEdit()
    {
        try{
            $oldComment = new parseObject('comments');
            $oldComment->authorName = Input::get('authorName');
            $oldComment->authorEmail = Input::get('authorEmail');
            $oldComment->commentBody = Input::get('commentBody');
            $oldComment->approved = (Input::get('approved') == 1) ? true : false;
            $oldComment->post = $oldComment->dataType('pointer',array('posts', Input::get('postId') ));

            $result = $oldComment->update(Input::get('objectId'));

            return Redirect::action(array('PostsController@getRecord', Input::get('objectId')))
                ->with('success','The comment has been updated');

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }


    public function getRecord($objectId = null)
    {
        if(is_null($objectId)){
            return Redirect::action('AdminCommentsController@getIndex')->with('error','Choose a comment to view');
        }

        try{
            $commentRecord = new parseQuery('comments');
            $commentRecord->where('objectId', $objectId);
            $commentRecord->whereInclude('post');
            $commentRecord->setLimit(1);
            $result = $commentRecord->find();

            $data = array(
                'item'=> $result->results[0],
            );

            return View::make('admin.comments.record')->with($data);


        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getDelete($objectId = null)
    {
        if(is_null($objectId)){
            return Redirect::action('AdminCommentsController@getIndex')->with('error','Choose a comment to delete');
        }

        try{
            $recordInfo = new parseObject('posts');
            $recordInfo->delete($objectId);

            return Redirect::action('AdminCommentsController@getIndex')
                ->with('success','The comment Has been deleted');

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getAdd($postObjectId = null)
    {
        if(is_null($postObjectId)){
            return Redirect::action('AdminPostsController@getIndex')->with('error','Choose a post first');
        }
        return View::make('admin.comments.add');
    }

    public function postAdd(){
        try{
            $comment = new parseObject('comments');
            $comment->authorName = Input::get('authorName');
            $comment->authorEmail = Input::get('authorEmail');
            $comment->commentBody = Input::get('commentBody');
            $comment->post = $comment->dataType('pointer',array('posts',Input::get('postId')));
            $comment->approved = true;

            $result = $comment->save();

            return Redirect::action(array('PostsController@getRecord', $result->results[0]->objectId))
                ->with('success','Your comment has been added');

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

}