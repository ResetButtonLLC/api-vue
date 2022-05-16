<?php

namespace App\Http\Controllers\API;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function getProfile(Request $request, Profile $profile)
    {
        return [
            'data' => [
                'activity' => true,
                'google_id' => '111-222-4567',
                'bid' => 0.04
            ]
        ];
    }

    public function setProfile(Request $request, Profile $profile)
    {
        return response('ok', 200);
    }

    public function getImport(Request $request, Profile $profile)
    {
        return [
            'data' => [
                'feed' => [
                    'url' => 'http://sample.com/feed.xml',
                    'login' => 'dimon',
                    'password' => 'qwerty123',
                ],
                'feed_fields' => [
                    'id' => "id",
                    'model' => "custom_label0"
                ],
                'fields' => ['is_custom' => true],

                'import' => [
                    'rules' => [
                        [
                            'conditions' =>
                            [
                                ['field' => "price", 'condition' => "GREATER_THAN", 'value' => ["999"], 'value2' => null]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public function setImport(Request $request, Profile $profile)
    {
        return response('ok', 200);
    }

    public function getAds(Request $request, Profile $profile)
    {
        return [
            'data' => [
                'no_category_in_model' => true,
                'no_cyrillic' => true,
                'format_price' => true,
            ]
        ];
    }

    public function setAds(Request $request, Profile $profile)
    {
        return response('ok', 200);
    }

    public function getKeywords(Request $request, Profile $profile)
    {
    }

    public function setKeywords(Request $request, Profile $profile)
    {
        return response('ok', 200);
    }

    public function getAutoupdate(Request $request, Profile $profile)
    {
    }

    public function setAutoupdate(Request $request, Profile $profile)
    {
        return response('ok', 200);
    }
}
