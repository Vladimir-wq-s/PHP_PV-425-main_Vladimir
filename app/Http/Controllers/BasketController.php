<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BasketController extends Controller
{
    public function index()
    {
//        Session::put('test', 123);
        dd(Session::get('test'));
    }
}
