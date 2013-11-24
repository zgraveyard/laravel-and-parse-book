<?php

class AdminCommentsController extends BaseController{

    public function __construct()
    {
        $this->perPage = Config::get('application.perPage');

        $pageNo = Input::get('page');
        $this->skip = (is_null($pageNo)) ? 0 : ( $this->perPage * ( $pageNo - 1)) ;
    }

    public function getIndex()
    {
        try{

            $fullComments = new parseQuery('comments');
            $fullComments->setCount(true);
            //this is the important field, which also get the post data
            $fullComments->whereInclude('post');
            $fullComments->setLimit($this->perPage);
            $fullComments->setSkip($this->skip);
            $fullComments->orderByDescending('createdAt');
            $comments = $fullComments->find();

            $paginator = Paginator::make($comments->results, $comments->count, $this->perPage);

            $data = array(
                'items'=> $comments->results,
                'paginator' => $paginator,
                'total' => $comments->count
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
            return Redirect::action('AdminCommentsController@getIndex')
                ->with('error','Choose a comment to delete');
        }

        try{
            $recordInfo = new parseObject('comments');
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
            return Redirect::action('AdminPostsController@getIndex')
                ->with('error','Choose a post first');
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

            return Redirect::action('AdminPostsController@getRecord', $result->results[0]->objectId)
                ->with('success','Your comment has been added');

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getPostComments($postObjectId = null)
    {
        try{
            if(is_null($postObjectId)){
                return Redirect::action('AdminPostsController@getIndex')
                    ->with('error','You must select a post to view');
            }

            $fullComments = new parseQuery('comments');
            $fullComments->setCount(true);
            //this is the important field, which also get the post data
            $fullComments->whereInclude('post');
            $fullComments->where('post',$fullComments->dataType('pointer',array('posts',$postObjectId)));
            $fullComments->setLimit($this->perPage);
            $fullComments->setSkip($this->skip);
            $fullComments->orderByDescending('createdAt');
            $comments = $fullComments->find();

            if($comments->count == 0){
                $postName = $this->_getPostName($postObjectId);
            }else{
                $postName = $comments->results[0]->post->title;
            }


            $paginator = Paginator::make($comments->results, $comments->count, $this->perPage);

            $data = array(
                'items'=> $comments->results,
                'paginator' => $paginator,
                'total' => $comments->count,
                'postName' => $postName
            );

            return View::make('admin.comments.post-comment')->with($data);

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getHide($objectId = null)
    {
        if(is_null($objectId)){
            return Redirect::action('AdminCommentsController@getIndex')
                ->with('error','Choose a comment to un-publish');
        }

        try{
            $recordInfo = new parseObject('comments');
            $recordInfo->approved = false;
            $recordInfo->update($objectId);

            return Redirect::action('AdminCommentsController@getIndex')
                ->with('success','The comment Has been un-published');

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getPublish($objectId = null)
    {
        if(is_null($objectId)){
            return Redirect::action('AdminCommentsController@getIndex')
                ->with('error','Choose a comment to approve');
        }

        try{
            $recordInfo = new parseObject('comments');
            $recordInfo->approved = true;
            $recordInfo->update($objectId);

            return Redirect::action('AdminCommentsController@getIndex')
                ->with('success','The comment Has been approved');

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    private function _getPostName($objectId = null)
    {
        if(is_null($objectId)){
            return Redirect::action('AdminPostsController@getIndex')
                ->with('error','You must select a record to view');
        }

        try{
            $recordInfo = new parseQuery('posts');
            $recordInfo->where('objectId',$objectId);
            $result = $recordInfo->find();

            if(!empty($result->results)){
                return $result->results[0]->title;
            }

            throw new Exception('No Records found');


        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

}