<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VuexPageController extends Controller
{
    public function index()
    {
        return view('vuex');
    }
}
