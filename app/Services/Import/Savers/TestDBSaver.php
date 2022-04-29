<?php

namespace App\Services\Import\Savers;

use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Services\Import\Saver;
use App\Services\Import\DTO\FeedItem;

class TestDBSaver extends Saver
{
    protected $categoryId;
    protected $vendorId;

    protected function createCategory($name)
    {
        if ($name) {
            $category = Category::firstOrCreate(['name' => $name], ['campaign_id' => 0]);
            $this->categoryId = $category->id;
        } else {
            $this->categoryId = 0;
        }
    }

    protected function createVendor($name)
    {
        if ($name) {
            $vendor = Vendor::firstOrCreate(['name' => $name, 'category_id' => $this->categoryId], ['campaign_id' => 0]);
            $this->vendorId = $vendor->id;
        } else {
            $this->vendorId = 0;
        }
    }

    public function processProduct(FeedItem $product)
    {
        dd($product);

        $this->createCategory($product->getCategory());
        $this->createVendor($product->getVendor());

        switch (Str::lower($product->getCurrency())) {
            case "uah":
                $currencyId = Product::CURRENCY_UAH;
                break;

            default:
                $currencyId = Product::CURRENCY_UNKNOWN;
        }

        Product::create([
            'category_id' => $this->categoryId,
            'vendor_id' => $this->vendorId,
            'is_available' => $product->isAvailable(),
            'model' => $product->getModel(),
            'description' => $product->getDescription(),
            'url' => $product->getUrl(),
            'mobile_url' => $product->getMobileUrl(),
            'sales_notes' => $product->getSalesNotes(),
            'rassrochka' => $product->getRassrochka(),
            'price' => $product->getPriceInteger(),
            'currency' => $currencyId,
            'is_exist' => true,
            'params' => $product->getParamArray()
        ]);
    }
}
