<?php

namespace App\Services\Import\Parsers;

use XMLReader;
use Illuminate\Support\Str;
use App\Services\Import\Parser;
use Illuminate\Support\Facades\Log;

class ParserXML extends Parser
{
    const ELEMENT_LIST = [
        'offers.offer.',
        '.item.',
        '.entry.'
    ];

    protected $reader;
    protected $tree;
    protected $allowedElements;
    protected $elementsArray = [];

    protected function getTreeString()
    {
        return implode('.', $this->tree);
    }

    protected function isAllowed()
    {
        $treeString = $this->getTreeString();

        foreach ($this->allowedElements as $allowed) {
            if (Str::is($allowed, $treeString)) {
                return true;
            }
        }

        return false;
    }

    protected function processElement()
    {
        //TODO: ЕСЛИ ЭЛЕМЕНТ ЗАКРЫТЫЙ, ТО ПРОВЕРКА БУДЕТ БЕЗ НЕГО В ДЕРЕВЕ
        if (!$this->reader->isEmptyElement) {
            array_push($this->tree, $this->reader->name);
        }

        try {
            if ($this->isAllowed()) {
                yield $this->converter->processElement(
                    $this->reader->readOuterXML(),
                    $this->reader->name
                );
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    protected function processEndElement()
    {
        array_pop($this->tree);
    }

    public function process($filename)
    {
        $this->allowedElements = $this->converter->getAllowedElements();

        libxml_use_internal_errors(true);

        /** @var XMLReader $this->reader  */
        $this->reader = new XMLReader;
        if (!$this->reader->open($filename, null, LIBXML_NOERROR | LIBXML_NOWARNING | 1)) {
            throw new \Exception("Cant open file: $filename");
        }

        $this->tree = [];

        while ($this->reader->read()) {
            switch ($this->reader->nodeType) {
                case XMLReader::ELEMENT:
                    yield from $this->processElement();
                    break;

                case XMLReader::END_ELEMENT:
                    $this->processEndElement();
                    break;
            }
        }

        $this->reader->close();
    }

    public function getUniqueElementsList(): array
    {
        return $this->converter->getProcessedElementList();
    }
}
