<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CreateRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Http\Resources\ClientResource;
use App\Http\Responses\Delete;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        return ClientResource::collection(
            auth()->user()->load('clients.profiles')->clients
        );
    }

    public function view(Client $client)
    {
        return new ClientResource($client->load('profiles'));
    }

    public function create(CreateRequest $request)
    {
        /* @var Client $client */
        $client = Client::factory($request->validated())->create();
        $client->users()->attach(auth()->user()->id); //Прикрепляем созданного клиента к юзеру его создавшего

        return new ClientResource($client);
    }

    public function update(Client $client, UpdateRequest $request)
    {
        $client->fill($request->validated())->save();

        return new ClientResource($client);
    }


    public function delete(Client $client)
    {
        /* @var Client $client */
        $client->profiles()->delete();
        $client->users()->detach();
        $client->delete();

        return new Delete();
    }
}
