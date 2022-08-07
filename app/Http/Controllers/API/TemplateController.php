<?php

namespace App\Http\Controllers\API;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SetTemplatesSmartRequest;
use App\Http\Requests\SetTemplatesRequest;

class TemplateController extends Controller
{
    const TYPE_GLOBAL = true;
    const TYPE_CATEGORY = false;

    const HEADLINE1 = ['value' => 'headline 1 to pin1', 'pin' => 1];
    const HEADLINE2 = ['value' => 'headline 2 (no pin)', 'pin' => 0];
    const HEADLINE3 = ['value' => 'headline 3 to pin1', 'pin' => 1];
    const DESCRIPTION1 = ['value' => 'description 1 to pin 1', 'pin' => 1];
    const DESCRIPTION2 = ['value' => 'description 1 (no pin)', 'pin' => 0];
    const DESCRIPTION3 = ['value' => 'description 3 text', 'pin' => 0];

    const TEMPLATE1 = [
        'name' => '',
        'headlines' => [self::HEADLINE1, self::HEADLINE2],
        'descriptions' => [self::DESCRIPTION1, self::DESCRIPTION2],
    ];
    const TEMPLATE2 = [
        'name' => 'для категорий "трусы"',
        'headlines' => [
            ['value' => 'лучшие трусы', 'pin' => 1]
        ],
        'descriptions' => [
            ['value' => 'ткань из шерсти и льна', 'pin' => 0],
            ['value' => 'быстрее покупай, а не зевай', 'pin' => 0]
        ],
        'rules' => [
            //#1
            [
                'conditions' =>
                [
                    //#1
                    ['field' => "title", 'condition' => "CONTAINS", 'value' => ["трусы"], 'value2' => null]
                ]
            ]
        ]
    ];

    public function getGlobal(Profile $profile)
    {
        return [
            'success' => true,
            'data' => [self::TEMPLATE1]
        ];
    }

    public function setGlobal(SetTemplatesRequest $request, Profile $profile)
    {
        return response('ok', 200);
    }

    public function getSmart(Profile $profile)
    {
        return [
            'success' => true,
            'data' => [self::TEMPLATE2]
        ];
    }

    public function setSmart(SetTemplatesSmartRequest $request, Profile $profile)
    {
        return response('ok', 200);
    }
}
