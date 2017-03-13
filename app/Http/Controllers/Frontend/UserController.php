<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Class FrontendController.
 */
class UserController extends Controller
{
    public function login()
    {
        return view('frontend.user.login');
    }

    public function register() 
    {
        return view('frontend.user.register');
    }

    public function postLogin() 
    {
        dd(1);
    }

    public function postRegister() 
    {
        dd(1);
    }
}
