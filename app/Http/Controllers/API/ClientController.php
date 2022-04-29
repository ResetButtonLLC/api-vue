<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CreateRequest;
use App\Http\Resources\ClientResource;
use App\Http\Responses\Delete;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        //auth()->user()->load('clients')->clients
        //todo решить с ответом, неправильно обрабатывается
        return ClientResource::collection(
           []
        );
    }

    public function create(CreateRequest $request)
    {
        /* @var Client $client */
        $client = Client::factory(['name' => $request->getName()])->create();
        $client->users()->attach(auth()->user()->id); //Прикрепляем созданного клиента к юзеру его создавшего

        return new ClientResource($client);
    }

    public function delete(Client $client)
    {
        /* @var Client $client */
        $client->users()->sync([]);
        $client->delete();

        return new Delete();
    }


}
