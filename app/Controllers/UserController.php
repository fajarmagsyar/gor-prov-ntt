<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function index()
    {
        

        return view('users/beranda');
    }
    public function gor()
    {

    	return view('users/v_gor');
    }
    public function pemesanan()
    {
    	return view ('users/pemesanan');
    }
}
