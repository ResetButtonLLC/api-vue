<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        //auth()->user()->load('clients')->clients
        //todo решить с ответом
        return ClientResource::collection(
           []
        );
    }

    public function create(ClientCreateRequest $request)
    {
        return new ClientResource(Client::create(['name' => $request->getName(), 'user_id' => Auth::id()]));
    }
}
