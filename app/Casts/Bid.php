<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Bid implements CastsAttributes
{

    public function get($model, $key, $value, $attributes)
    {
        return $value/100;
    }


    public function set($model, $key, $value, $attributes)
    {
        return $value*100;
    }

}
