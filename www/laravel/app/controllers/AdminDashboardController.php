<?php

class AdminDashboardController extends BaseController{

    public function getIndex()
    {
        return View::make('admin.dashboard');
    }

} 