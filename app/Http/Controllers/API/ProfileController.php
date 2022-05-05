<?php

namespace App\Http\Controllers\API;

use App\Helpers\DBHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\CreateRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //bind to user
    public function index(Request $request)
    {
        return ProfileResource::collection(
            Profile::where('user_id', Auth::id())->get()
        );
    }

    public function create(CreateRequest $request)
    {
        $project = $request->getproject();

        $profile = Profile::create([
            'name' => $request->getName(),
            'project_id' => $request->getprojectId(),
            'user_id' => Auth::id(),
            'db' => DBHelper::getName($project->name, $request->getName())
        ]);

        if (!$profile) {
            return response('Failed to create profile', 500);
        }

        if (!DBHelper::init($project->name, $request->getName())) {
            return response('Failed to init profile DB', 500);
        }

        return new ProfileResource($profile);
    }
}
