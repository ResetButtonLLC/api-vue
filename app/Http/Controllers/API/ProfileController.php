<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\CreateRequest;
use App\Http\Requests\Profile\UpdateRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Http\Responses\DeleteResponse;

class ProfileController extends Controller
{

    public function view (Profile $profile)
    {
        return new ProfileResource($profile);
    }

    public function create(CreateRequest $request)
    {
          $profile = Profile::factory($request->validated())->create();
          return new ProfileResource($profile);
    }

    public function update(Profile $profile, UpdateRequest $request)
    {
        $profile->fill($request->validated())->save();
        return new ProfileResource($profile);
    }

    public function delete(Profile $profile)
    {
        $profile->delete();
        return new DeleteResponse();
    }

}
