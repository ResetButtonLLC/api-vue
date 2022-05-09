<?php

namespace App\Http\Controllers\API;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\PreviewRequest;

class PreviewController extends Controller
{
    public function getGroups(PreviewRequest $request, Profile $profile)
    {
        $filters = $request->getFilters();
        $page = $request->getPage();

        return [
            'success' => true,
            'data' => []
        ];
    }

    public function getAds(PreviewRequest $request, Profile $profile)
    {
        $filters = $request->getFilters();
        $page = $request->getPage();

        return [
            'success' => true,
            'data' => []
        ];
    }

    public function getKeywords(PreviewRequest $request, Profile $profile)
    {
        $filters = $request->getFilters();
        $page = $request->getPage();

        return [
            'success' => true,
            'data' => []
        ];
    }
}
