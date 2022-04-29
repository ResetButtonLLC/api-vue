<?php

namespace App\Services\Import\Savers;

use App\Services\Import\Saver;
use App\Services\Import\DTO\FeedItem;

class TestSaver extends Saver
{
    public function toString($value)
    {
        if (!is_array($value)) {
            return (string)$value;
        }

        $result = '[';

        foreach ($value as $element) {
            if (is_array($element)) {
                $result .= $this->toString($element);
            } else $result .= $element;
        }

        $result .= ']';

        return $result;
    }

    public function processProduct(FeedItem $product)
    {
        foreach ($product->toArray() as $key => $value) {
            echo ($key . ' : ' . $this->toString($value) . '<br>');
        }

        echo '<br>';
    }
}
