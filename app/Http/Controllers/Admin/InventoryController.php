<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function __invoke()
    {
        return view('admin.inventories');
    }
}
