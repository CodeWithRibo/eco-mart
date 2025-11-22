<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __invoke()
    {
        return view('user.products');
    }
}
