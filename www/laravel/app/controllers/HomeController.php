<?php

class HomeController extends BaseController
{

    protected $perPage;
    protected $skip;

    public function __construct()
    {
        $this->perPage = Config::get('application.homePerPage');
        $pageNo        = Input::get('page');
        $this->skip    = (is_null($pageNo)) ? 0 : ($this->perPage * ($pageNo - 1));

    }

    public function getIndex()
    {
        try {
            //$posts = new parseQuery('posts');
            //$posts->setCount(true);
            //$posts->setLimit($this->perPage);
            //$posts->where('active', true);
            //$posts->setSkip($this->skip);
            //$posts->orderByDescending('createdAt');
            //$result    = $posts->find();

            $posts = new Post();
            $result = $posts->getPosts(true, $this->perPage, $this->skip);

            $paginator = Paginator::make($result->results, $result->count, $this->perPage);

            $data = array(
                'posts'     => $result->results,
                'paginator' => $paginator,
                'total'     => $result->count
            );

            return View::make('site.index')->with($data);

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getPost($postId = null)
    {
        if (is_null($postId)) {
            return Redirect::back()->with('error', 'You cant access this file directly.');
        }

        try {
            //$post = new parseQuery('posts');
            //$post->where('objectId', $postId);
            //$post->where('active', true);
            //$result   = $post->find();

            $post = new Post();
            $result   = $post->getItem($postId, true);

            //$comments = $this->_getComment($result->results[0]->objectId);
            $comments = $this->_getComment($result->objectId);
            $data     = array(
                //'post'          => $result->results[0],
                'post'          => $result,
                'comments'      => $comments->results,
                'commentsCount' => $comments->count);
            return View::make('site.post')->with($data);

        } catch (Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    private function _getComment($postId = null)
    {
        try {
            $comments = new parseQuery('comments');
            $comments->setCount(true);
            $comments->where('post', $comments->dataType('pointer', array('posts', $postId)));
            $comments->where('approved', true);
            $comments->orderByDescending('createdAt');
            $result = $comments->find();
            return $result;
        } catch (ParseLibraryException $e) {
            throw new Exception($e->getMessage());
        }
    }

public function postAddComment()
{
    try {
        $allData              = Input::all();
        $comment              = new parseObject('comments');
        $comment->authorName  = Input::get('authorName');
        $comment->authorEmail = Input::get('authorEmail');
        $comment->commentBody = Input::get('commentBody');
        $comment->post        = $comment->dataType('pointer', array('posts', Input::get('postId')));
        $comment->approved    = false;
        $result = $comment->save();

        return Redirect::action('HomeController@getPost', Input::get('postId'))
                ->with('success', 'Your comment has been added, and waiting for approval.');
    } catch (ParseLibraryException $e) {
        return Redirect::back()->with('error', $e->getMessage());
    }
}
}