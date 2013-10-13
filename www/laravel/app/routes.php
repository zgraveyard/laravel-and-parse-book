<?php

Route::get('/login',array('as' => 'login', 'uses' => 'AuthController@getLogin'));
Route::post('/login',array('uses'=>'AuthController@postLogin'));
Route::get('/logout', array('uses'=>'AuthController@getLogout'));

Route::get('/',function(){
    $test = new parseQuery('posts');

    return Response::json($test->find());
});

Route::get('/admin',array('before'=>'auth',function(){
    return Redirect::to('/admin/posts');
}));

//'before'=>'auth',
Route::group(array('before'=>'auth','prefix'=>'admin'),function(){
    Route::controller('posts','AdminPostsController');
    Route::controller('comments','AdminCommentsController');
});

//Route::group(array('before'=>'auth'),function(){
//    Route::controller('/','HomeController');
//});