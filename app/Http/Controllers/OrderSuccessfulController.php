<?php

namespace App\Http\Controllers;

class OrderSuccessfulController extends Controller
{
    public function __invoke()
    {
        return view ('user.order-successful');
    }
}
