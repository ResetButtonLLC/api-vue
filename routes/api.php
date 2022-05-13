<?php

use App\Http\Controllers\API\CampaignController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\FeedController;
use App\Http\Controllers\API\PreviewController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\ReplaceController;
use App\Http\Controllers\API\TemplateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

Route::middleware('auth:sanctum')->group(
    function () {
        Route::get('/user', [UserController::class, 'info']);

        /** CLIENTS */
        Route::get('/clients', [ClientController::class, 'index']);
        Route::post('/client/create', [ClientController::class, 'create']);

        /** PROFILES */
        Route::get('/profiles', [ProfileController::class, 'index']);
        Route::post('/profile/create', [ProfileController::class, 'create']);
        Route::post('/profile/{profile}/settings', [ProfileController::class, 'settings']);

        /** CAMPAIGNS */
        Route::get('/campaigns/{profile}/imported', [CampaignController::class, 'getImported']);
        Route::get('/campaigns/{profile}/all', [CampaignController::class, 'getAll']);
        Route::post('/campaigns/{profile}/set', [CampaignController::class, 'set']);

        /** CATEGORIES */
        Route::get('/categories/{profile}/get', [CategoryController::class, 'get']);
        Route::post('/categories/{profile}/set', [CategoryController::class, 'set']);

        /** TEMPLATES */
        Route::get('/templates/{profile}/global', [TemplateController::class, 'getGlobal']);
        Route::post('/templates/{profile}/global/set', [TemplateController::class, 'setGlobal']);
        Route::get('/templates/{profile}/smart', [TemplateController::class, 'getSmart']);
        Route::post('/templates/{profile}/smart/set', [TemplateController::class, 'setSmart']);

        /** FEED */
        Route::post('/feed/{profile}/upload', [FeedController::class, 'upload']);
        Route::post('/feed/{profile}/set', [FeedController::class, 'set']);

        /** REPLACEMENTS */
        Route::get('/replacements/{profile}/ads/brands/get', [ReplaceController::class, 'getAdBrands']);
        Route::post('/replacements/{profile}/ads/brands/set', [ReplaceController::class, 'setAdBrands']);
        Route::get('/replacements/{profile}/ads/replaces/get', [ReplaceController::class, 'getAdReplaces']);
        Route::post('/replacements/{profile}/ads/replaces/set', [ReplaceController::class, 'setAdReplaces']);

        Route::get('/replacements/{profile}/keywords/brands/get', [ReplaceController::class, 'getKeywordBrands']);
        Route::post('/replacements/{profile}/keywords/brands/set', [ReplaceController::class, 'setKeywordBrands']);
        Route::get('/replacements/{profile}/keywords/replaces/get', [ReplaceController::class, 'getKeywordReplaces']);
        Route::post('/replacements/{profile}/keywords/replaces/set', [ReplaceController::class, 'setKeywordReplaces']);
        Route::get('/replacements/{profile}/keywords/colors/get', [ReplaceController::class, 'getKeywordColors']);
        Route::post('/replacements/{profile}/keywords/colors/set', [ReplaceController::class, 'setKeywordColors']);
        Route::get('/replacements/{profile}/keywords/keys/get', [ReplaceController::class, 'getKeywordKeys']);
        Route::post('/replacements/{profile}/keywords/keys/set', [ReplaceController::class, 'setKeywordKeys']);

        /** PREVIEW */
        Route::post('/preview/{profile}/groups', [PreviewController::class, 'getGroups']);
        Route::post('/preview/{profile}/ads', [PreviewController::class, 'getAds']);
        Route::post('/preview/{profile}/keywords', [PreviewController::class, 'getKeywords']);
    }
);
