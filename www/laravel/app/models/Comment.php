<?php 


class Comment {

    protected $tablename = 'comments';

    /**
     * @param bool $active default value is null
     * @param int $limit
     * @param int $skip
     * @param string $orderBy
     * @return bool|mixed
     * @throws Exception
     */
    public function getComments($active = null, $limit = 5, $skip = 0, $orderBy ='createdAt' )
    {
        try{
            $fullComments = new parseQuery('comments');
            $fullComments->setCount(true);
            $fullComments->whereInclude('post');
            $fullComments->setLimit($limit);
            $fullComments->setSkip($skip);
            $fullComments->orderByDescending($orderBy);

            if(!is_null($active))
                $fullComments->where('approved',$active);

            $comments = $fullComments->find();

            return $comments;
        } catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), 406);
        }
    }

    /**
     * @param int $commentId
     * @return bool|mixed
     * @throws Exception
     */
    public function getComment($commentId)
    {
        try{
            $fullComment = new parseQuery('comments');
            $fullComment->whereInclude('post');
            $fullComment->setLimit(1);
            $fullComment->where('objectId',$commentId);

            $comment = $fullComment->find();

            return $comment;
        } catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), 406);
        }
    }

    /**
     * @param int $postId post object id.
     * @param null $status
     * @param null $skip
     * @param null $limit
     * @return bool|mixed
     * @throws Exception
     */
    public function getPostComments($postId, $status = null, $skip = null, $limit = null)
    {
        try{

            $postComments = new parseQuery($this->tablename);
            $postComments->setCount(true);
            $postComments->whereInclude('post');
            $postComments->where('post',$fullComments->dataType('pointer',array('posts',$postId)));

            if(!is_null($limit))
                $postComments->setLimit($limit);

            if(!is_null($skip))
                $postComments->setSkip($skip);

            if(!is_null($status))
                $postComments->where('approved',$status);

            $postComments->orderByDescending('createdAt');
            $comments = $postComments->find();

            return $comments;

        } catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), 406);
        }
    }

    /**
     * @param array $input
     * @param bool $isEdit
     * @return bool|mixed
     * @throws Exception
     */
    public function handelComment($input, $isEdit = false)
    {
        try{
            $commentData = new parseObject($this->tablename);

            if(isset($input['authorEmail']))
                $commentData->authorEmail = $input['authorEmail'];

            if(isset($input['postId']))
                $commentData->post = $commentData->data(array('pointer',array('posts',$input['postId'])));

            if(isset($input['authorName']))
                $commentData->authorName = $input['authorName'];

            if(isset($input['commentBody']))
                $commentData->commentBody = $input['commentBody'];

            $commentData->approved = (isset($input['approved'])) ? $input['approved'] :  false;

            if($isEdit){
                $result = $commentData->update($input['objectId']);
            } else {
                $result = $commentData->save();
            }

            return $result;

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), 406);
        }
    }

    /**
     * @param int $commentId the comment id which we want to delete.
     * @return bool it will always return true, since parse does not return anything on success.
     * @throws Exception
     */
    public function deleteComment($commentId)
    {
        try{

            $comment  = new parseQuery($this->tablename);
            $comment->delete($commentId);

            return true;

        } catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), 406);
        }
    }

} 