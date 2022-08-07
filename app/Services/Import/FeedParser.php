<?php

namespace App\Services\Import;

use App\Services\Import\Parsers\ParserCSV;
use App\Services\Import\Parsers\ParserXML;
use App\Services\Import\Converters\GoogleXML;
use App\Services\Import\Converters\YandexXML;
use App\Services\Import\Converters\ConverterCSV;

class FeedParser
{
    protected $saver;
    protected $typeChecker;
    protected $parser;

    public function __construct(Saver $saver, TypeChecker $typeChecker)
    {
        $this->saver = $saver;
        $this->typeChecker = $typeChecker;
    }

    public function process($filename, array $customFieldsPattern = [], $isUseCSVNumberPattern = false)
    {
        $feedType = $this->typeChecker->getType($filename);

        $this->parser = $this->initParser($feedType, $customFieldsPattern, $isUseCSVNumberPattern);

        foreach ($this->parser->process($filename) as $product) {
            if ($product) {
                $this->saver->processProduct($product);
            }
        }
    }

    public function getParsedElements()
    {
        return $this->parser->getUniqueElementsList();
    }

    protected function initParser($feedType, $customFieldsPattern, $isUseCSVNumberPattern)
    {
        switch ($feedType) {
            case TypeChecker::TYPE_XML_YANDEX:
                $converter = new YandexXML();
                $converter->setCustomFieldsPattern($customFieldsPattern);

                return new ParserXML($converter);

            case TypeChecker::TYPE_XML_GOOGLE:
                $converter = new GoogleXML();
                $converter->setCustomFieldsPattern($customFieldsPattern);

                return new ParserXML($converter);

            case TypeChecker::TYPE_CSV:
                $converter = new ConverterCSV();
                $converter->setCustomFieldsPattern($customFieldsPattern);

                return new ParserCSV($converter, $isUseCSVNumberPattern);

            default:
                throw new \Exception("Unknown feed type");
        }
    }
}
