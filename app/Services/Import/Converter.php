<?php

namespace App\Services\Import;

abstract class Converter
{
    abstract public function __construct(array $patterns);
    abstract public function getAllowedElements(): array;
    abstract public function getProcessedElementList(): array;

    abstract public function processElement($productText, $nodeName);
}
