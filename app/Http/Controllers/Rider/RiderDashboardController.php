<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;

class RiderDashboardController extends Controller
{
    public function __invoke()
    {
        return view('rider.dashboard');
    }
}
