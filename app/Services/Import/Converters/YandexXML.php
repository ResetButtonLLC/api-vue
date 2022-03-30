<?php

namespace App\Services\Import\Converters;

use SimpleXMLElement;
use App\Services\Import\Converters\ConverterXML;

class YandexXML extends ConverterXML
{
    const MONTH = ['01' => 'январь', '02' => 'февраль', '03' => 'март', '04' => 'апрель', '05' => 'май', '06' => 'июнь', '07' => 'июль', '08' => 'август', '09' => 'сентябрь', '10' => 'октябрь', '11' => 'ноябрь', '12' => 'декабрь'];
    const MONTH_CASE = ['01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля', '05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа', '09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'];
    const MONTH_UA  = ['01' => 'січень', '02' => 'лютий', '03' => 'березень', '04' => 'квітень', '05' => 'травень', '06' => 'червень', '07' => 'липень', '08' => 'серпень', '09' => 'вересень', '10' => 'жовтень', '11' => 'листопад', '12' => 'грудень'];
    const MONTH_UA_CASE = ['01' => 'січня', '02' => 'лютого', '03' => 'березня', '04' => 'квітня', '05' => 'травня', '06' => 'червня', '07' => 'липня', '08' => 'серпня', '09' => 'вересня', '10' => 'жовтня', '11' => 'листопада', '12' => 'грудня'];

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

    protected function getConcertParams($productText)
    {
        $offer = new SimpleXMLElement($productText, LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NOWARNING | 1);

        $params = [];
        foreach ($offer->param as $param) {
            $params[(string) $param->attributes()['name']] = (string) $param;
        }



        if (isset($offer->place)) {
            $params['place'] = (string) $offer->place;
        }
        if (isset($offer->name3)) {
            $params['name3'] = trim((string) $offer->name3);
        }



        $d = 0;
        $dates = [];
        if (isset($offer->date)) {
            $dates[] = trim((string) $offer->date);
        }



        if (isset($params['дата'])) {
            $dates[] = date('Y-m-d H:i:s', strtotime(trim((string) $params['дата'])));
        }

        if (!isset($params['date' . $d])) {
            $d++;
        }
        while (isset($params['date' . $d])) {
            $dates[] = $params['date' . $d];
            unset($params['date' . $d]);
            $d++;
        }



        $d = 1;
        foreach ($dates as $value) {
            $params['date' . $d] = $value;
            $d++;
        }

        $currentDate = date('Y-m-d H:i:s');
        $closestDate = $lastDate = '';

        $d = 1;
        while (isset($params['date' . $d])) {
            if (!$closestDate && $currentDate < $params['date' . $d]) {
                $closestDate = $params['date' . $d];
            } else {
                if ($currentDate < $params['date' . $d] && $params['date' . $d] < $closestDate) {
                    $closestDate = $params['date' . $d];
                }
            }
            if (!$lastDate && $currentDate < $params['date' . $d]) {
                $lastDate = $params['date' . $d];
            } else {
                if ($currentDate < $params['date' . $d] && $params['date' . $d] > $lastDate) {
                    $lastDate = $params['date' . $d];
                }
            }
            $d++;
        }

        if ($closestDate) {
            $params['date'] = date('j', strtotime($closestDate)) . ' ' . self::MONTH_CASE[date('m', strtotime($closestDate))];
            $params['closest_date'] = $closestDate;
            $params['monthRuName'] = self::MONTH[date('m', strtotime($closestDate))];
            $params['monthUkName'] = self::MONTH_UA[date('m', strtotime($closestDate))];
            $params['monthRuNameR'] = self::MONTH_CASE[date('m', strtotime($closestDate))];
            $params['monthUkNameR'] = self::MONTH_UA_CASE[date('m', strtotime($closestDate))];
        }
        if ($lastDate) {
            $params['last_date'] = $lastDate;
        }

        if (!$closestDate && !$lastDate) {
            return [];
        }

        if (!isset($params['cityRuName']) && isset($params['Город'])) {
            $params['cityRuName'] = $params['Город'];
        }

        if (!isset($params['cityRuNameR']) && isset($params['cityRuName'])) {
            $params['cityRuNameR'] = $params['cityRuName'];
        }

        if (!isset($params['cityUkNameR']) && isset($params['cityUkName'])) {
            $params['cityUkNameR'] = $params['cityUkName'];
        }

        return $params;
    }

    public function processElement($productText, $nodeName)
    {
        $inputArray = (array)new SimpleXMLElement($productText, LIBXML_NOCDATA | LIBXML_NOERROR | LIBXML_NOWARNING | 1);

        switch ($nodeName) {
            case 'category':
                $this->addCategory(
                    $this->getText($inputArray, '@attributes.id'),
                    $this->getText($inputArray, '0'),
                    $this->getText($inputArray, '@attributes.parent_id', 0)
                );

                return null;

            case 'offer':
                $inputArray['category'] = $this->getCategoryName($inputArray['categoryId'] ?? 0);

                /** !CONCERT PARAM! */
                if (isset($inputArray['param'])) {
                    $inputArray['param'] = $this->getConcertParams($productText);
                }

                return $this->makeProduct($inputArray);

            default:
                throw new \Exception('Unknown data in process element');
        }
    }
}
