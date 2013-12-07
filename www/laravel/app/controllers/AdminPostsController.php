<?php

class AdminPostsController extends BaseController{


    public function __construct()
    {
        $this->perPage = Config::get('application.perPage');

        $pageNo = Input::get('page');
        $this->skip = (is_null($pageNo)) ? 0 : ( $this->perPage * ( $pageNo - 1)) ;

    }

    public function getIndex()
    {
        try{
            //$records = new parseQuery('posts');
            //$records->setCount(true);
            //$records->setLimit($this->perPage);
            //$records->setSkip($this->skip);
            //$result = $records->find();

            $posts = new Post();
            $result = $posts->getPosts(null,$this->perPage,$this->skip);

            $paginator = Paginator::make($result->results,$result->count,$this->perPage);

            $data = array(
                'items'=> $result->results,
                'paginator' => $paginator,
                'total' => $result->count
            );

            return View::make('admin.posts.list')->with($data);

        } catch(Exception $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getRecord($objectId = null)
    {
        if(is_null($objectId)){
            return Redirect::action('AdminPostsController@getIndex')
                ->with('error','You must select a record to view');
        }

        try{
            //$recordInfo = new parseQuery('posts');
            //$recordInfo->where('objectId',$objectId);
            //$result = $recordInfo->find();

            $recordInfo = new Post();
            $result = $recordInfo->getItem($objectId);

            //$data = array('item'=>$result->results[0]);
            $data = array('item'=>$result);

            return View::make('admin.posts.record')->with($data);

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getDelete($objectId = null){
        if(is_null($objectId)){
            return Redirect::action('AdminPostsController@getIndex')
                ->with('error','You must select a record to delete');
        }

        try{
            //$recordInfo = new parseObject('posts');
            //$recordInfo->delete($objectId);

            $recordInfo = new Post('posts');
            $recordInfo->deleteItem($objectId);

            return Redirect::action('AdminPostsController@getIndex')
                    ->with('success','Your Post Has been deleted');

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getAdd(){
        return View::make('admin.posts.add');
    }

    public function postAdd(){
        try{

            $post = new Post();
            $result = $post->handleItem(Input::all());

            return Redirect::action('AdminPostsController@getRecord', $result->objectId)
                            ->with('success','Your Post Has been added');

        }catch(Exception $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getEdit($objectId = null)
    {
        if(is_null($objectId)){
            return Redirect::to('/admin/posts')->with('error','You must select a record to edit');
        }

        try{
            //$recordInfo = new parseQuery('posts');
            //$recordInfo->where('objectId',$objectId);
            //$result = $recordInfo->find();

            $recordInfo = new Post();
            $result = $recordInfo->getItem($objectId);

            //$data = array('item'=>$result->results[0]);
            $data = array('item'=>$result);

            return View::make('admin.posts.edit')->with($data);

        }catch(Exception $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function postEdit()
    {
        try{
            $post = new Post();
            $result = $post->handleItem(Input::all(), true);

            return Redirect::action('AdminPostsController@getRecord', Input::get('objectId'))
                ->with('success','Your Post Has been updated');

        }catch(Exception $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getHide($objectId = null){
        if(is_null($objectId)){
            return Redirect::action('AdminPostsController@getIndex')
                ->with('error','You must select a record to un-publish');
        }

        try{

            $input = array('active'=>false, 'objectId'=>$objectId);
            $post = new Post();
            $result = $post->handleItem($input, true);

            return Redirect::action('AdminPostsController@getIndex')
                ->with('success','Your Post Has been un-publish');

        }catch(Exception $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getPublish($objectId = null){
        if(is_null($objectId)){
            return Redirect::action('AdminPostsController@getIndex')
                ->with('error','You must select a record to publish');
        }

        try{
            $input = array('active'=>true, 'objectId'=>$objectId);
            $post = new Post();
            $result = $post->handleItem($input, true);

            return Redirect::action('AdminPostsController@getIndex')
                ->with('success','Your Post Has been published');

        }catch(Exception $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }


}