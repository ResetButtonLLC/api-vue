<?php

namespace App\Services\Import\DTO;

class FeedItem
{
    protected $data;

    function __get($property)
    {
        return $this->data[$property] ?? null;
    }

    function __set($property, $value)
    {
        $this->data[$property] = $this->normalizeData($value);
    }

    public function __construct()
    {
        $this->data = [];
    }

    public static function fromArray($array)
    {
        $result = new self;

        foreach ($array as $key => $value) {
            $result->{$key} = $value;
        }

        return $result;
    }

    public static function fromArrayWithPattern($array, $pattern)
    {
        $result = new self;

        foreach ($pattern as $patternTo => $patternFrom) {
            $result->{$patternTo} = $result->valueFromPattern($array, $patternFrom, null);
        }

        return $result;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    protected function valueFromPattern($array, $searchedValue, $defaultValue)
    {
        if (!is_array($searchedValue)) {
            $searchedValue = [$searchedValue];
        }

        foreach ($searchedValue as $value) {
            $findedValue = data_get($array, $value, null);

            if ($findedValue !== null) {
                return $findedValue;
            }
        }

        return $defaultValue;
    }

    protected function normalizeString($string)
    {
        return trim($string);
    }

    protected function normalizeArray($array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            $result[$key] = $this->normalizeData($value);
        }

        return $result;
    }

    protected function normalizeData($items)
    {
        if (is_array($items)) {
            return $this->normalizeArray($items);
        }

        if (is_string($items)) {
            return $this->normalizeString($items);
        }

        return $items;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of available
     */
    public function isAvailable()
    {
        return in_array(strtolower($this->available), ['in stock', 'in_stock', 'available for order', 'preorder', '1', 'true', 'available']);
    }

    /**
     * Get the value of url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the value of mobileUrl
     */
    public function getMobileUrl()
    {
        return $this->mobileUrl;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        preg_match('/[0-9]+[.,]{1,1}[0-9]{1,2}/', $this->price, $result);

        if (is_array($result) && count($result) == 1) {
            return $result[0];
        }

        return intval($this->price);
    }

    public function getPriceInteger()
    {
        return intval($this->price);
    }

    /**
     * Get the value of currency
     */
    public function getCurrency()
    {
        preg_match('/[a-zA-Z]+/', $this->currency, $result);

        if (is_array($result) && count($result) == 1) {
            return $result[0];
        }

        return '';
    }

    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Get the value of vendor
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Get the value of model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of salesNotes
     */
    public function getSalesNotes()
    {
        return $this->salesNotes;
    }

    /**
     * Get the value of rassrochka
     */
    public function getRassrochka()
    {
        return $this->rassrochka;
    }

    /**
     * Get the value of param
     */
    public function getParamArray()
    {
        return $this->param;
    }

    public function getParamJson()
    {
        return json_encode($this->param);
    }
}
