<?php

namespace App\Services\Import\Converters;

use SimpleXMLElement;
use App\Services\Import\Converters\ConverterXML;

class YandexXML extends ConverterXML
{
    protected $categories = [];

    protected $defaultPatterns = [
        'id' => '@attributes.id',
        'available' => ['@attributes.available', 'available'],
        'url' => 'url',
        'mobileUrl' => 'mobile_url',
        'price' => 'price',
        'currency' => 'currencyId',
        'category' => 'category',
        'vendor' => 'vendor',
        'model' => ['model', 'name'],
        'description' => 'description',
        'salesNotes' => 'sales_notes',
        'rassrochka' => 'rassrochka',
        'param' => 'param',
    ];

    const ALLOWED_ELEMENTS = [
        '*categories.category',
        '*offers.offer'
    ];

    protected function addCategory($id, $name, $parentId = 0)
    {
        $this->categories[$id] = [
            'name' => $name,
            'parent_id' => $parentId
        ];
    }

    protected function getCategoryName($id)
    {
        return $this->categories[$id]['name'] ?? 'unknown';
    }

    public function getAllowedElements(): array
    {
        return self::ALLOWED_ELEMENTS;
    }

    public function processElement($productText, $nodeName)
    {
        $inputArray = (array)new SimpleXMLElement($productText, LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NOWARNING | 1);

        switch ($nodeName) {
            case 'category':
                $this->addCategory(
                    data_get($inputArray, '@attributes.id'),
                    data_get($inputArray, '0'),
                    data_get($inputArray, '@attributes.parent_id', 0)
                );

                return null;

            case 'offer':
                $inputArray['category'] = $this->getCategoryName($inputArray['categoryId'] ?? 0);

                $offer = new SimpleXMLElement($productText, LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NOWARNING | 1);

                $params = [];
                foreach ($offer->param as $param) {
                    $params[] = (array)$param;
                }
                $inputArray['param'] = $params;

                return $this->makeProduct($inputArray, $this->defaultPatterns);

            default:
                throw new \Exception('Unknown data in process element');
        }
    }
}
