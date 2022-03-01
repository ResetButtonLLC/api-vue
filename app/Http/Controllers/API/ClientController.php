<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        return json_encode(
            [
                'data' => [
                    [
                        'id' => 1,
                        'name' => 'sample',
                        'profiles' => [
                            [
                                'id' => 1,
                                'name' => 'sample profile'
                            ]
                        ]
                    ],
                    [
                        'id' => 2,
                        'name' => 'empty',
                        'profiles' => []
                    ]
                ]
            ]
        );
    }
}
