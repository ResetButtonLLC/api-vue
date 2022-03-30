<?php

namespace App\Services\Import\Converters;

use Illuminate\Support\Arr;
use App\Services\Import\Converter;
use App\Services\Import\DTO\Pattern;
use App\Services\Import\DTO\Product;

abstract class ConverterXML extends Converter
{
    /** @var array $defaultPatterns */
    protected $defaultPatterns;

    /** @var Pattern[] $patterns */
    protected $patterns = [];

    protected $processedElementList = [];

    public function __construct(array $patterns)
    {
        foreach ($patterns as $name => $source) {
            $this->defaultPatterns[$name] = $source;
        }

        foreach ($this->defaultPatterns as $name => $pattern) {
            $this->patterns[] = new Pattern($name, $pattern);
        }
    }

    public function getPatterns()
    {
        return $this->patterns;
    }

    protected function getText($array, $names, $default = '')
    {
        if (!is_array($names)) {
            $names = [$names];
        }

        foreach ($names as $name) {
            $result = data_get($array, $name, null);

            if ($result !== null) {
                return $result;
            }
        }

        return $default;
    }

    protected function makeProduct($inputArray)
    {
        $this->addProcessedElement($inputArray);

        $productArray = [];

        foreach ($this->patterns as $pattern) {
            $productArray[$pattern->getName()] = $this->getText($inputArray, $pattern->getSource());
        }

        return Product::fromArray($productArray);
    }

    public function getProcessedElementList(): array
    {
        return $this->processedElementList;
    }

    protected function addProcessedElement($inputArray)
    {
        foreach ($inputArray as $key => $array) {
            if (is_array($array) && $key == '@attributes') {
                foreach ($array as $name => $value) {
                    $inputArray[$key . '.' . $name] = $value;
                }
            }
        }

        $inputArray = Arr::except($inputArray, '@attributes');

        foreach ($inputArray as $key => $param) {
            if (in_array($key, $this->processedElementList)) {
                continue;
            }

            array_push($this->processedElementList, $key);
        }
    }
}
