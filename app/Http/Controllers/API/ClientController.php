<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        return ClientResource::collection(
            Client::where('user_id', Auth::id())->get()
        );
    }

    public function create(ClientCreateRequest $request)
    {
        return new ClientResource(Client::create(['name' => $request->getName(), 'user_id' => Auth::id()]));
    }
}
