<?php 


class Comment {

    protected $tablename = 'comments';

    public function getComments()
    {

    }

    public function getPostComments($postId, $status = null, $skip = null, $limit = null)
    {
        try{

            $fullComments = new parseQuery($this->tablename);
            $fullComments->setCount(true);
            $fullComments->whereInclude('post');
            $fullComments->where('post',$fullComments->dataType('pointer',array('posts',$postId)));

            if(!is_null($limit))
                $fullComments->setLimit($limit);

            if(!is_null($skip))
                $fullComments->setSkip($skip);

            $fullComments->orderByDescending('createdAt');
            $comments = $fullComments->find();

            return $comments;

        } catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }


    public function deleteComment($commentId)
    {
        try{

            $comment  = new parseQuery($this->tablename);
            $comment->delete($commentId);

            return true;

        } catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

} 