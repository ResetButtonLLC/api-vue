<?php

namespace App\Http\Responses\Errors;

use Illuminate\Contracts\Support\Responsable;


class Validation implements Responsable
{

    private array $validationErrors;

    public function __construct(array $validationErrors)
    {
        $this->validationErrors = $validationErrors;
        $this->toResponse(request());
    }

    public function toResponse($request)
    {
        response()->json(['data' => ['errors' => $this->validationErrors]],422)->send();
    }
}
