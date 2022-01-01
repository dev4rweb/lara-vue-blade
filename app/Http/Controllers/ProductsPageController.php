<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsPageController extends Controller
{
    public function index()
    {
        return view('products-ajax');
    }
}
