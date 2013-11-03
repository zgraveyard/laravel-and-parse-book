<?php

class AuthController extends BaseController{

    public function getLogin()
    {
        return View::make('login');
    }

    public function postLogin()
    {
        if(Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))){
               return Redirect::intended('/admin/dashboard');
        }else{
            return Redirect::to('/login')
                ->with('error','You dont have access permission, sorry.');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/login');
    }


}