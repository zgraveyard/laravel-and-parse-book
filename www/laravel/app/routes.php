<?php

Route::get('/login',array('as' => 'login', 'uses' => 'AuthController@getLogin'));
Route::post('/login',array('uses'=>'AuthController@postLogin'));
Route::get('/logout', array('as'=>'logout','uses'=>'AuthController@getLogout'));

Route::get('/admin',array('before'=>'auth',function(){
    return Redirect::action('AdminDashboardController@getIndex');
}));

//'before'=>'auth',
Route::group(array('before'=>'auth','prefix'=>'admin'),function(){
    Route::controller('posts','AdminPostsController');
    Route::controller('comments','AdminCommentsController');
    Route::controller('dashboard','AdminDashboardController');
});

Route::controller('/','HomeController');