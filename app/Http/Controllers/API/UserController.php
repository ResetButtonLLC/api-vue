<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\User as UserRequests;

class UserController extends Controller
{

    public function info()
    {
        return new UserResource(auth()->user());
    }

    public function index()
    {
        return UserResource::collection(User::paginate());
    }

    public function view(User $user)
    {
        return new UserResource($user->load('projects'));
    }

    public function update(UserRequests\UpdateRequest $request, User $user)
    {
        $role = $request->input('role');
        $projects = $request->input('projects');

        $user->role = $role;
        $user->save();

        $user->projects()->sync($projects);

        return new UserResource($user->load('projects'));
    }
}
