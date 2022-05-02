<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function upload(Request $request, Profile $profile)
    {
        return response('ok');
    }

    public function set(Request $request, Profile $profile)
    {
        return response('ok', 200);
    }
}
