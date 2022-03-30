<?php

namespace App\Http\Controllers;

use App\Helpers\DBHelper;
use App\Services\CategoryList;
use App\Services\VendorList;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request)
    {
        DBHelper::fresh('Алло премиум', 'основной');
    }
}
