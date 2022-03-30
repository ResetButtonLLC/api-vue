<?php

namespace App\Services\Import\Parsers;

use App\Services\Import\Parser;
use App\Services\Import\Converter;

class ParserCSV extends Parser
{
    const NUMBER_PARAM_SETTING = 'use_number_fields';
    const BUFFER_SIZE = 5000;

    protected $file;
    protected $delimiters = [
        "\r" => 0,
        "\n" => 0,
        "\t" => 0,
        ";" => 0,
        "," => 0
    ];

    protected $titleNames = [];
    protected $buffer = '';
    protected $lineDelimiter;
    protected $elementDelimiter;
    protected $useNumberFields;

    public function __construct(Converter $converter, $useNumberFields = false)
    {
        parent::__construct($converter);
        $this->useNumberFields = $useNumberFields;
    }

    protected function loadBuffer()
    {
        if (feof($this->file)) return false;

        $this->buffer .= fread($this->file, self::BUFFER_SIZE);

        return true;
    }

    protected function getPositionOfLineEnd()
    {
        return mb_strpos($this->buffer, $this->lineDelimiter);
    }

    protected function getLine()
    {
        while ($this->getPositionOfLineEnd() || $this->loadBuffer() || mb_strlen($this->buffer)) {
            return $this->processBuffer($this->buffer);
        }

        return false;
    }

    protected function slitLine($line)
    {
        $bracketsOpened = false;
        $wordBuffer = "";
        $result = [];

        for ($currentPosition = 0; $currentPosition < mb_strlen($line); $currentPosition++) {
            $currentChar = mb_substr($line, $currentPosition, 1);

            if ($currentChar == '"') {
                $bracketsOpened = !$bracketsOpened;
                continue;
            }

            if ($currentChar == $this->elementDelimiter && !$bracketsOpened) {
                $result[] = $wordBuffer;
                $wordBuffer = "";
                continue;
            }

            $wordBuffer .= $currentChar;
        }

        if (mb_strlen($wordBuffer)) {
            $result[] = $wordBuffer;
        }

        return $result;
    }

    protected function processBuffer()
    {
        $lineSize = $this->getPositionOfLineEnd();

        if ($lineSize === false) {
            $lineSize = mb_strlen($this->buffer);
        }

        $line = mb_substr($this->buffer, 0, $lineSize);

        $this->buffer = mb_substr($this->buffer, $lineSize + 1);

        return $this->slitLine($line);
    }

    public function process($filename)
    {
        if (($this->file = fopen($filename, "r")) === FALSE) {
            throw new \Exception("Cant open file: $filename");
        }

        $this->findDelimiters();

        if ($this->useNumberFields) {
            $this->titleNames = null;
        } else {
            $this->titleNames = $this->getLine();
        }

        while ($elements = $this->getLine()) {
            $finalArray = [];

            foreach ($elements as $id => $element) {
                $name = $this->titleNames[$id] ?? $id;
                $finalArray[$name] = $element;
            }

            yield $this->converter->processElement($finalArray, '');
        }

        fclose($this->file);
    }

    protected function resetFilePosition()
    {
        fseek($this->file, 0, SEEK_SET);
    }

    protected function getTextForDelimiterTesting()
    {
        $result = fread($this->file, self::BUFFER_SIZE);

        $this->resetFilePosition();

        return $result;
    }

    protected function findDelimiters()
    {
        $line = $this->getTextForDelimiterTesting();

        foreach ($this->delimiters as $delimiter => $count) {
            $this->delimiters[$delimiter] = substr_count($line, $delimiter);
        }

        asort($this->delimiters);

        $this->elementDelimiter = key(array_slice($this->delimiters, -1));
        $this->lineDelimiter = key(array_slice($this->delimiters, -2));
    }

    public function getUniqueElementsList(): array
    {
        return $this->titleNames;
    }
}
