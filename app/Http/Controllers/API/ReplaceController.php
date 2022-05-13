<?php

namespace App\Http\Controllers\API;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SetReplacementRequest;

class ReplaceController extends Controller
{
    const GET_REQUEST_RESPONSE = [
        'success' => true,
        'data' => [
            'isGlobal' => true,
            'globalText' => "sample1\nsample2\nsample3\nsample4",
            'profileText' => "sample2\nsample4"
        ]
    ];

    public function getAdBrands(Request $request, Profile $profile)
    {
        return self::GET_REQUEST_RESPONSE;
    }

    public function setAdBrands(SetReplacementRequest $request, Profile $profile)
    {
        return response('ok', 200);
    }

    public function getAdReplaces(Request $request, Profile $profile)
    {
        return self::GET_REQUEST_RESPONSE;
    }

    public function setAdReplaces(SetReplacementRequest $request, Profile $profile)
    {
        return response('ok', 200);
    }

    public function getKeywordBrands(Request $request, Profile $profile)
    {
        return self::GET_REQUEST_RESPONSE;
    }

    public function setKeywordBrands(SetReplacementRequest $request, Profile $profile)
    {
        return response('ok', 200);
    }

    public function getKeywordReplaces(Request $request, Profile $profile)
    {
        return self::GET_REQUEST_RESPONSE;
    }

    public function setKeywordReplaces(SetReplacementRequest $request, Profile $profile)
    {
        return response('ok', 200);
    }

    public function getKeywordColors(Request $request, Profile $profile)
    {
        return self::GET_REQUEST_RESPONSE;
    }
    public function setKeywordColors(SetReplacementRequest $request, Profile $profile)
    {
        return response('ok', 200);
    }

    public function getKeywordKeys(Request $request, Profile $profile)
    {
        return self::GET_REQUEST_RESPONSE;
    }

    public function setKeywordKeys(SetReplacementRequest $request, Profile $profile)
    {
        return response('ok', 200);
    }
}
