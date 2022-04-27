<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function getImported(Profile $profile)
    {
        return [
            'success' => true,
            'data' => [
                [
                    'id' => 2,
                    'name' => "samle",
                    'googleId' => 7776665554
                ]
            ]
        ];
    }

    public function getAll(Profile $profile)
    {
        return [
            'success' => true,
            'data' => [
                [
                    'id' => 1,
                    'name' => "test",
                    'googleId' => 123456789
                ],

                [
                    'id' => 2,
                    'name' => "samle",
                    'googleId' => 7776665554
                ],

                [
                    'id' => 3,
                    'name' => "okok",
                    'googleId' => 112233441
                ]
            ]
        ];
    }
}
