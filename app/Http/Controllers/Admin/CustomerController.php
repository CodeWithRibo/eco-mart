<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function __invoke()
    {
        return view('admin.customers');
    }
}
