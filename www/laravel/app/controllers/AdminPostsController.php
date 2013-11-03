<?php

class AdminPostsController extends BaseController{


    public function __construct()
    {
        $this->perPage = Config::get('application.perPage');

        $pageNo = Input::get('page');
        $this->skip = (is_null($pageNo['page'])) ? 0 : ( $this->perPage * ( $pageNo['page'] - 1)) ;

    }


    public function getIndex()
    {
        try{
            $records = new parseQuery('posts');
            $records->setCount(true);
            $records->setLimit($this->perPage);
            $records->setSkip($this->skip);
            $result = $records->find();

            $paginator = Paginator::make($result->results,$result->count,$this->perPage);

            $data = array(
                'items'=> $result->results,
                'paginator' => $paginator,
                'total' => $result->count
            );

            return View::make('admin.posts.list')->with($data);

        } catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getRecord($objectId = null)
    {
        if(is_null($objectId)){
            return Redirect::to('/admin/posts')->with('error','You must select a record to view');
        }

        try{
            $recordInfo = new parseQuery('posts');
            $recordInfo->where('objectId',$objectId);
            $result = $recordInfo->find();

            $data = array('item'=>$result->results[0]);

            return View::make('admin.posts.record')->with($data);

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getDelete($objectId = null){
        if(is_null($objectId)){
            return Redirect::to('/admin/posts')->with('error','You must select a record to delete');
        }

        try{
            $recordInfo = new parseObject('posts');
            $recordInfo->delete($objectId);

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
        // i will trust that you have send the data, and that you need to store it
        // as we said before we are here to talk about parse.com not laravel 4

        try{
            $postData = new parseObject('posts');
            $postData->title = Input::get('title');
            $postData->body = Input::get('body');
            $postData->active = true;

            $result = $postData->save();

            return Redirect::action(array('PostsController@getRecord', $result->results[0]->objectId))
                            ->with('success','Your Post Has been added');

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }

    public function getEdit($objectId = null)
    {
        if(is_null($objectId)){
            return Redirect::to('/admin/posts')->with('error','You must select a record to edit');
        }

        try{
            $recordInfo = new parseQuery('posts');
            $recordInfo->where('objectId',$objectId);
            $result = $recordInfo->find();

            $data = array('item'=>$result->results[0]);

            return View::make('admin.posts.edit')->with($data);

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function postEdit()
    {
        try{
            $postData = new parseObject('posts');
            $postData->title = Input::get('title');
            $postData->body = Input::get('body');
            $postData->active = true;

            $result = $postData->update(Input::get('objectId'));

            return Redirect::action(array('PostsController@getRecord', Input::get('objectId')))
                ->with('success','Your Post Has been updated');

        }catch(ParseLibraryException $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }



}