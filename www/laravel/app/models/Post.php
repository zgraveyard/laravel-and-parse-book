<?php

class Post {

    protected $tablename = 'posts';


    /**
     * @param null $active
     * @param int $limit
     * @param int $skip
     * @param string $orderBy
     * @return bool|mixed
     * @throws Exception
     */
    public function getPosts($active = null, $limit = 5, $skip = 0, $orderBy ='createdAt' )
    {
        try{
            $records = new parseQuery($this->tablename);

            if(!is_null($active)){
                $records->whereEqualTo('active', $active);
            }

            $records->orderByDescending('createdAt');
            $records->setCount(true);
            $records->setLimit($limit);
            $records->setSkip($skip);
            $result = $records->find();

            return $result;

        } catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param $objectId the post object Id
     * @param null $active the post status
     * @return null
     * @throws Exception
     */
    public function getItem($objectId, $active = null)
    {
        try{
            $recordInfo = new parseQuery($this->tablename);
            $recordInfo->where('objectId',$objectId);

            if(!is_null($active))
                $recordInfo->whereEqualTo('active',$active);

            $result = $recordInfo->find();

            if(!empty($result->results)){
                return $result->results[0];
            }

            return null;

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param $input input data
     * @param bool $isEdit to check if its update or create
     * @return bool|mixed
     * @throws Exception
     */
    public function handleItem($input, $isEdit = false)
    {
        try{
            $postData = new parseObject($this->tablename);

            if(isset($input['title']))
                $postData->title = $input['title'];

            if(isset($input['body']))
                $postData->body = $input['body'];

            $postData->active = (isset($input['active'])) ? $input['active'] :  true;

            if($isEdit){
                $result = $postData->update($input['objectId']);
            } else {
                $result = $postData->save();
            }

            return $result;

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param $itemId post id
     * @return bool
     * @throws Exception
     */
    public function deleteItem($itemId)
    {
        try{

            $comments = new Comment();
            $commentsResult = $comments->getPostComments($itemId);
            if($commetsResult->count > 0){
                foreach($commetsResult->results as $item){
                    $comments->deleteComment($item->objectId);
                }
            }

            $recordInfo = new parseObject($this->tablename);
            $recordInfo->delete($objectId);

            return true;

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());

        } catch(Exception $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
} 