<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function __invoke()
    {
        return view('user.checkout');
    }
}
