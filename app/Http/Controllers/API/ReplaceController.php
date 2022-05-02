<?php

namespace App\Http\Controllers\API;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReplaceController extends Controller
{
    public function get(Request $request, Profile $profile)
    {
        return [
            'success' => true,
            'data' => [
                [
                    'from' => 'from',
                    'to' => 'to'
                ],
                [
                    'from' => 'dell',
                    'to' => 'дел'
                ]
            ]
        ];
    }

    public function set(Request $request, Profile $profile)
    {
        return response('ok', 200);
    }
}
