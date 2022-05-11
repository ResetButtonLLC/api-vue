<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    const VENDOR_BEHAVIOR_OTHER_ACTIVE = 2;
    const VENDOR_BEHAVIOR_OTHER_UNACTIVE = 1;

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
                    'behavior' => self::VENDOR_BEHAVIOR_OTHER_ACTIVE,
                    'campaign' => null,
                    'keyword_types' => [self::BROAD, self::PHRASE, self::EXACT],
                    'vendors' => [
                        [
                            'id' => 100,
                            'name' => 'test1'
                        ],
                        [
                            'id' => 101,
                            'name' => 'test2'
                        ],
                    ],
                    'customVendors' => []
                ],

                [
                    'id' => 2,
                    'name' => "трусы",
                    'is_active' => false,
                    'behavior' => self::VENDOR_BEHAVIOR_OTHER_ACTIVE,
                    'campaign' => null,
                    'keyword_types' => [self::BROAD, self::PHRASE, self::EXACT],
                    'vendors' => [
                        [
                            'id' => 100,
                            'name' => 'test1'
                        ],
                        [
                            'id' => 101,
                            'name' => 'test2'
                        ],
                    ],
                    'customVendors' => []
                ],

                [
                    'id' => 3,
                    'name' => "кросы",
                    'is_active' => true,
                    'behavior' => self::VENDOR_BEHAVIOR_OTHER_ACTIVE,
                    'campaign' => null,
                    'keyword_types' => [self::BROAD, self::PHRASE],
                    'vendors' => [
                        [
                            'id' => 1,
                            'name' => "найк",
                        ],
                        [
                            'id' => 2,
                            'name' => "адидас",
                        ],
                        [
                            'id' => 3,
                            'name' => "пума",
                        ],
                        [
                            'id' => 4,
                            'name' => "рибок",
                        ],
                    ],

                    'customVendors' => [
                        [
                            'id' => 1,
                            'campaign' => null,
                            'keyword_types' => [self::BROAD],
                        ],
                        [
                            'id' => 4,
                            'campaign' => null,
                            'keyword_types' => [self::EXACT],
                        ],
                    ]
                ],
            ]
        ];
    }

    public function set(Request $request, Profile $profile)
    {
        return response('ok', 200);
    }
}
