<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = 'Home';
        return view('home', $data);
    }

    public function sign_in()
    {
        $data['title'] = 'Masuk';
        return view('login', $data);
    }

    public function sign_up()
    {
        $data['title'] = 'Daftar';
        return view('register', $data);
    }
}
