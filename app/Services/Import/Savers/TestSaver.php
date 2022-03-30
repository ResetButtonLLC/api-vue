<?php

namespace App\Services\Import\Savers;

use App\Services\Import\Saver;
use App\Services\Import\DTO\Product;

class TestSaver extends Saver
{
    public function processProduct(Product $product)
    {
        foreach ($product->toArray() as $key => $value) {
            if (is_array($value)) {
                $value = implode(',', $value);
            }

            echo ($key . ' : ' . $value . '<br>');
        }

        echo '<br>';
    }
}
