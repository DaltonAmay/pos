<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('layout/header');
        echo view('layout/aside');
        echo view('home');
        echo view('layout/footer');
    }
}
