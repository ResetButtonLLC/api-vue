<?php

namespace App\Services\Import;

use App\Services\Import\DTO\Product;

abstract class Saver
{
    abstract public function processProduct(Product $product);
}
