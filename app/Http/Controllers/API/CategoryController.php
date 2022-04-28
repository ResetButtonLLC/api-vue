<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    const BROAD = 1;
    const PHRASE = 2;
    const EXACT = 3;

    public function get(Profile $profile)
    {
        return [
            'success' => true,
            'data' => [
                [
                    'id' => 1,
                    'name' => "шапки",
                    'is_active' => false,
                    'campaign' => null,
                    'keyword_types' => [self::BROAD, self::PHRASE, self::EXACT],
                    'vendors' => [],
                ],
                [
                    'id' => 2,
                    'name' => "трусы",
                    'is_active' => true,
                    'campaign' => null,
                    'keyword_types' => [self::BROAD, self::PHRASE],
                    'vendors' => [
                        [
                            'id' => 1,
                            'name' => "найк",
                            'is_active' => true,
                            'campaign' => null,
                            'keyword_types' => [self::BROAD],
                        ],
                        [
                            'id' => 2,
                            'name' => "адидас",
                            'is_active' => false,
                            'campaign' => null,
                            'keyword_types' => [self::BROAD, self::PHRASE],
                        ],
                    ],
                ],
            ]
        ];
    }
}
