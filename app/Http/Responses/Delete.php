<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class Delete implements Responsable
{

    public function toResponse($request)
    {
        return response('', 204);
    }

}
