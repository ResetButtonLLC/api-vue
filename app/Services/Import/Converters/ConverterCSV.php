<?php

namespace App\Services\Import\Converters;

use App\Services\Import\Converter;
use App\Services\Import\DTO\Pattern;
use App\Services\Import\DTO\Product;

class ConverterCSV extends Converter
{
    protected $defaultPatterns = [
        'id' => ['id', 'productID'],
        'url' => ['URL', 'url', 'link'],
        'category' => ['productCategoryName', 'Catname', 'Cat', 'google product category'],
        'price' => ['price', 'productPriceLocal'],
        'currency' => 'price',
        'vendor' => ['BrandName', 'brand', 'Brand'],
        'availability' => ['available', 'productAvailability_new', 'productAvailability', 'Status'],
        'model' => ['Name', 'model', 'title'],
        'mobileUrl' => ['mobileUrl', 'link'],
    ];

    protected $patterns = [];

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

    public function processElement($productText, $nodeName)
    {
        return $this->makeProduct($productText);
    }

    protected function makeProduct($inputArray)
    {
        $productArray = [];

        foreach ($this->patterns as $pattern) {
            $productArray[$pattern->getName()] = $this->getText($inputArray, $pattern->getSource());
        }

        return Product::fromArray($productArray);
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

    public function getAllowedElements(): array
    {
        return ['*'];
    }

    public function getProcessedElementList(): array
    {
        return [];
    }
}
