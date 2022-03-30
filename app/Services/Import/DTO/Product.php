<?php

namespace App\Services\Import\DTO;

class Product
{
    protected $id;
    protected $available;
    protected $url;
    protected $mobileUrl;
    protected $price;
    protected $currency;
    protected $category;
    protected $vendor;
    protected $model;
    protected $description;
    protected $salesNotes;
    protected $rassrochka;
    protected $param;

    public function __construct($id, $available, $url,  $mobileUrl, $price, $currency, $category, $vendor, $model, $description, $salesNotes, $rassrochka, $param)
    {
        $this->id = $id;
        $this->available = $available;
        $this->url = $url;
        $this->mobileUrl = $mobileUrl;
        $this->price = $price;
        $this->currency = $currency;
        $this->category = $category;
        $this->vendor = $vendor;
        $this->model = $model;
        $this->description = $description;
        $this->salesNotes = $salesNotes;
        $this->rassrochka = $rassrochka;
        $this->param = $param;
    }

    public static function fromArray($array)
    {
        return new self(
            data_get($array, 'id', 0),
            data_get($array, 'available', false),
            data_get($array, 'url', ''),
            data_get($array, 'mobileUrl', ''),
            data_get($array, 'price', 0),
            data_get($array, 'currency', 'UAH'),
            data_get($array, 'category', 'unknown'),
            data_get($array, 'vendor', ''),
            data_get($array, 'model', ''),
            data_get($array, 'description', ''),
            data_get($array, 'salesNotes', ''),
            data_get($array, 'rassrochka', ''),
            data_get($array, 'param', '')
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'available' => $this->isAvailable() ? 'Есть' : 'Нет',
            'url' => $this->url,
            'mobileUrl' => $this->mobileUrl,
            'price' => $this->getPrice(),
            'currency' => $this->getCurrency(),
            'category' => $this->category,
            'vendor' => $this->vendor,
            'model' => $this->model,
            'description' => $this->description,
            'salesNotes' => $this->salesNotes,
            'rassrochka' => $this->rassrochka,
            'param' => $this->getParamJson()
        ];
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
