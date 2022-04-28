<?php

namespace App\Http\Controllers\API;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplateController extends Controller
{
    const TYPE_ALL = 'all';
    const TYPE_DEFAULT = 'default';
    const TYPE_CATEGORY = 'category';

    const HEADLINE1 = ['value' => 'headline 1 to pin1', 'pin' => 1];
    const HEADLINE2 = ['value' => 'headline 2 (no pin)', 'pin' => 0];
    const HEADLINE3 = ['value' => 'headline 3 to pin1', 'pin' => 1];
    const DESCRIPTION1 = ['value' => 'description 1 to pin 1', 'pin' => 1];
    const DESCRIPTION2 = ['value' => 'description 1 (no pin)', 'pin' => 0];
    const DESCRIPTION3 = ['value' => 'description 3 text', 'pin' => 0];

    const TEMPLATE1 = [
        'name' => 'стандарт10000',
        'type' => self::TYPE_DEFAULT,
        'headlines' => [self::HEADLINE1, self::HEADLINE2],
        'descriptions' => [self::DESCRIPTION1, self::DESCRIPTION2],
        'categories' => []
    ];
    const TEMPLATE2 = [
        'name' => 'для категорий "трусы"',
        'type' => self::TYPE_CATEGORY,
        'headlines' => [self::HEADLINE3],
        'descriptions' => [self::DESCRIPTION2, self::DESCRIPTION3],
        'categories' => [2]
    ];

    const TEMPLATE_LIST = [self::TEMPLATE1, self::TEMPLATE2];

    public function get(Profile $profile)
    {
        return [
            'success' => true,
            'data' => self::TEMPLATE_LIST
        ];
    }
}
