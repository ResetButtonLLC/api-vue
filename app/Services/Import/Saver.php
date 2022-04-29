<?php

namespace App\Services\Import;

use App\Services\Import\DTO\FeedItem;

abstract class Saver
{
    abstract public function processProduct(FeedItem $product);
}
