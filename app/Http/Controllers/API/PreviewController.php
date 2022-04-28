<?php

namespace App\Http\Controllers\API;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreviewController extends Controller
{
    public function getGroups(Profile $profile)
    {
        return [
            'success' => true,
            'data' => []
        ];
    }

    public function getAds(Profile $profile)
    {
        return [
            'success' => true,
            'data' => []
        ];
    }

    public function getKeywords(Profile $profile)
    {
        return [
            'success' => true,
            'data' => []
        ];
    }
}
