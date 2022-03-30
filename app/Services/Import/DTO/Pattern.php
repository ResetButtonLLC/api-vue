<?php

namespace App\Services\Import\DTO;

class Pattern
{
    protected $name;
    protected $source;

    public function __construct($name, $source)
    {
        $this->name = $name;
        $this->source = $source;
    }

    /**
     * Get the value of source
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }
}
