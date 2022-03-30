<?php

namespace App\Services\Import\Converters;

use SimpleXMLElement;
use App\Services\Import\Converters\ConverterXML;

class GoogleXML extends ConverterXML
{
    const ALLOWED_ELEMENTS = [
        '*.item', '*.entry'
    ];

    protected $defaultPatterns = [
        'id' => 'id',
        'available' => 'availability',
        'url' => 'link',
        'mobileUrl' => ['mobile_url', 'url', 'link'],
        'price' => 'price',
        'currency' => 'price',
        'category' => ['category', 'product_type', 'google_product_category', 'custom_label_0'],
        'vendor' => 'brand',
        'model' => 'title',
        'description' => 'description',
        'salesNotes' => 'salesNotes',
        'rassrochka' => 'rassrochka',
        'param' => 'param',
    ];

    public function getAllowedElements(): array
    {
        return self::ALLOWED_ELEMENTS;
    }

    public function processElement($productText, $nodeName)
    {
        $xml = new SimpleXMLElement($productText, LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NOWARNING | 1, false, 'http://base.google.com/ns/1.0');

        $attributes = (array)$xml->attributes();

        $inputData = (array)$xml + $attributes;

        return $this->makeProduct($inputData);
    }
}
