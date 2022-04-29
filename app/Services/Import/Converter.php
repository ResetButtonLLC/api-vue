<?php

namespace App\Services\Import;

use Illuminate\Support\Arr;

abstract class Converter
{
    protected $defaultPatterns = [];
    protected $processedElementList = [];

    abstract public function getAllowedElements(): array;
    abstract public function processElement($productText, $nodeName);

    public function setCustomFieldsPattern($customFieldsPattern)
    {
        foreach ($customFieldsPattern as $patternTo => $patternFrom) {
            $this->defaultPatterns[$patternTo] = $patternFrom;
        }
    }

    public function getProcessedElementList(): array
    {
        return $this->processedElementList;
    }

    protected function addProcessedElement($inputArray)
    {
        foreach ($inputArray as $key => $array) {
            if (is_array($array) && $key == '@attributes') {
                foreach ($array as $name => $value) {
                    $inputArray[$key . '.' . $name] = $value;
                }
            }
        }

        $inputArray = Arr::except($inputArray, '@attributes');

        foreach ($inputArray as $key => $param) {
            if (in_array($key, $this->processedElementList)) {
                continue;
            }

            array_push($this->processedElementList, $key);
        }
    }
}
