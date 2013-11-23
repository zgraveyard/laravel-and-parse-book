<?php

class HomeController extends BaseController {

	public function getIndex()
	{
        try{
            $posts = new parseQuery('posts');
            $result = $posts->find();

            $data = array(
                'posts' => $result->results
            );


            return View::make('site.index')->with($data);

        } catch(ParseLibraryException $e){
            throw new Exception($e->getMessage());
        }
	}

}