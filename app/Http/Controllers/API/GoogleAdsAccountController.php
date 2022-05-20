<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GoogleAdsAccountResource;
use Illuminate\Http\Request;
use App\Models\GoogleAdsAccount;

class GoogleAdsAccountController extends Controller
{
    public function index()
    {
        return GoogleAdsAccountResource::collection(GoogleAdsAccount::all());
    }

    public function view(GoogleAdsAccount $googleAdsAccount)
    {
        return new GoogleAdsAccountResource($googleAdsAccount);
    }
}
