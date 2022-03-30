<?php

namespace App\Http\Controllers\API;

use App\Helpers\DBHelper;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProfileResource;
use App\Http\Requests\ProfileCreateRequest;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return ProfileResource::collection(
            Profile::where('user_id', Auth::id())->get()
        );
    }

    public function create(ProfileCreateRequest $request)
    {
        $client = $request->getClient();

        $profile = Profile::create([
            'name' => $request->getName(),
            'client_id' => $request->getClientId(),
            'user_id' => Auth::id(),
            'db' => DBHelper::getName($client->name, $request->getName())
        ]);

        if (!$profile) {
            return response('Failed to create profile', 500);
        }

        if (!DBHelper::init($client->name, $request->getName())) {
            return response('Failed to init profile DB', 500);
        }

        return new ProfileResource($profile);
    }
}
