<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function __invoke()
    {
        return view('user.invoice');
    }
}
