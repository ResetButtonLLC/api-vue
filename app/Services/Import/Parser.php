<?php

namespace App\Services\Import;

use App\Services\Import\Converter;

abstract class Parser
{
    /** @var Converter $converter */
    protected $converter;

    public function __construct(Converter $converter)
    {
        $this->converter = $converter;
    }

    abstract public function process($filename);
    abstract public function getUniqueElementsList(): array;
}
