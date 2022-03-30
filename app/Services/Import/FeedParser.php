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

    public function process($filename, array $patterns = [])
    {
        $feedType = $this->typeChecker->getType($filename);
        $this->parser = $this->initParser($feedType, $patterns);

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

    protected function initParser($feedType, array $patterns = [])
    {
        switch ($feedType) {
            case TypeChecker::TYPE_XML_YANDEX:
                $converter = new YandexXML($patterns);
                return new ParserXML($converter);

            case TypeChecker::TYPE_XML_GOOGLE:
                $converter = new GoogleXML($patterns);
                return new ParserXML($converter);

            case TypeChecker::TYPE_CSV:
                $useNumberFields = $patterns[ParserCSV::NUMBER_PARAM_SETTING] ?? false;

                $converter = new ConverterCSV($patterns);
                return new ParserCSV($converter, $useNumberFields);

            default:
                throw new \Exception("Unknown feed type");
        }
    }
}
