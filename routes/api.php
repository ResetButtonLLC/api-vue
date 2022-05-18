<?php

use App\Http\Controllers\API\CampaignController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\FeedController;
use App\Http\Controllers\API\PreviewController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\ReplaceController;
use App\Http\Controllers\API\SettingsController;
use App\Http\Controllers\API\TemplateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->group(
    function () {

        /* USERS */
        Route::get('/user', [UserController::class, 'info'])->name('user.info'); //Для совместимости c роутом
        Route::get('/me', [UserController::class, 'me'])->name('user.me');
        Route::middleware('can:user.management')->group(function () {
            Route::get('/users/all', [UserController::class, 'all'])->name('users.all');
            Route::get('/user/{user}', [UserController::class, 'view'])->name('user.view');
            Route::patch('/user/{user}', [UserController::class, 'update'])->name('user.update');
        });

        /** PROJECTS */
        Route::get('/projects/all', [ProjectController::class, 'all'])->name('projects.all');
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::post('/project', [ProjectController::class, 'create'])->name('project.create');
        Route::middleware('can:project.access,project')->group(function () {
            Route::get('/project/{project}', [ProjectController::class, 'view'])->name('project.view');
            Route::patch('/project/{project}', [ProjectController::class, 'update'])->name('project.update');
            Route::delete('/project/{project}', [ProjectController::class, 'delete'])->name('project.delete');
        });

        /** PROFILES */
        Route::post('/profile', [ProfileController::class, 'create'])->name('profile.create'); //todo check project access
        Route::middleware('can:profile.access,profile')->group(function () {
            Route::get('/profile/{profile}', [ProfileController::class, 'view'])->name('profile.view');
            Route::patch('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile/{profile}', [ProfileController::class, 'delete'])->name('profile.delete');
        });

        Route::get('/profiles', [ProfileController::class, 'index']);
        Route::post('/profile/create', [ProfileController::class, 'create']);
        Route::post('/profile/{profile}/settings', [ProfileController::class, 'settings']);

        /** SETTINGS */
        Route::get('/settings/profile/{profileId}/get', [SettingsController::class, 'getProfile']);
        Route::post('/settings/profile/{profileId}/set', [SettingsController::class, 'setProfile']);
        Route::get('/settings/import/{profileId}/get', [SettingsController::class, 'getImport']);
        Route::post('/settings/import/{profileId}/set', [SettingsController::class, 'setImport']);
        Route::get('/settings/ads/{profileId}/get', [SettingsController::class, 'getAds']);
        Route::post('/settings/ads/{profileId}/set', [SettingsController::class, 'setAds']);
        Route::get('/settings/keywords/{profileId}/get', [SettingsController::class, 'getKeywords']);
        Route::post('/settings/keywords/{profileId}/set', [SettingsController::class, 'setKeywords']);
        Route::get('/settings/autoupdate/{profileId}/get', [SettingsController::class, 'getAutoupdate']);
        Route::post('/settings/autoupdate/{profileId}/set', [SettingsController::class, 'setAutoupdate']);

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
        Route::get('/replacements/ads', [ReplaceController::class, 'getAdsGlobal']);
        Route::post('/replacements/ads', [ReplaceController::class, 'setAdsGlobal']);
        Route::get('/replacements/keywords', [ReplaceController::class, 'getKeywordsGlobal']);
        Route::post('/replacements/keywords', [ReplaceController::class, 'setKeywordsGlobal']);

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
