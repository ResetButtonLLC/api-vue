<?php

namespace App\Services\Import\Converters;

use Illuminate\Support\Arr;
use App\Services\Import\Converter;
use App\Services\Import\DTO\FeedItem;

abstract class ConverterXML extends Converter
{
    protected function makeProduct($inputArray, $pattern)
    {
        $this->addProcessedElement($inputArray);

        return FeedItem::fromArrayWithPattern($inputArray, $pattern);
    }
}
