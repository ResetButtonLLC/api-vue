<?php

namespace App\Services\Import\Converters;

use App\Services\Import\Converter;
use App\Services\Import\DTO\FeedItem;

class ConverterCSV extends Converter
{
    protected $defaultPatterns = [
        'id' => ['id', 'productID'],
        'description' => 'description',
        'url' => ['URL', 'url', 'link'],
        'category' => ['productCategoryName', 'Catname', 'Cat', 'google product category'],
        'price' => ['price', 'productPriceLocal'],
        'currency' => 'price',
        'vendor' => ['BrandName', 'brand', 'Brand'],
        'availability' => ['available', 'availability', 'productAvailability_new', 'productAvailability', 'Status'],
        'model' => ['Name', 'model', 'title'],
        'mobileUrl' => ['mobileUrl', 'link'],
    ];

    public function processElement($productText, $nodeName)
    {
        $this->addProcessedElement($productText);

        return FeedItem::fromArrayWithPattern($productText, $this->defaultPatterns);
    }

    public function getAllowedElements(): array
    {
        return ['*'];
    }
}
