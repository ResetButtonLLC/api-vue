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
        return new UserResource($user->load('clients'));
    }

    public function update(UserRequests\UpdateRequest $request, User $user)
    {
        $role = $request->input('role');
        $clients = $request->input('clients');

        $user->role = $role;
        $user->save();

        $user->clients()->sync($clients);

        return new UserResource($user);
    }
}
