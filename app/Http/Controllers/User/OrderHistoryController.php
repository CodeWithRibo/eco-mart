<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class OrderHistoryController extends Controller
{
    public function __invoke()
    {
        return view('user.order-history');
    }
}
