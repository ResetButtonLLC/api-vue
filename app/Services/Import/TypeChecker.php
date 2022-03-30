<?php

namespace App\Services\Import;

use XMLReader;

class TypeChecker
{
    const YANDEX_XML_ELEMENTS_ARRAY = [
        'categories', 'offers'
    ];
    const GOOGLE_XML_ELEMENTS_ARRAY = [
        'item', 'entry'
    ];

    const TYPE_UNKNOWN = 0;
    const TYPE_XML_YANDEX = 2;
    const TYPE_XML_GOOGLE = 4;
    const TYPE_CSV = 8;

    const MAX_XML_ITERATION = 1000;

    protected $filename;
    protected $isTryingWithoutEncoding = false;

    public function getType($filename)
    {
        $this->filename = $filename;
        $mimeType = mime_content_type($filename);

        $tmpType = self::TYPE_UNKNOWN;

        switch ($mimeType) {
            case 'text/xml':
            case 'application/xhtml+xml':
            case 'application/xml':
            case 'text/html':
                return $this->testXML(self::TYPE_XML_GOOGLE);
                break;

            case 'application/vnd.ms-excel':
            case 'text/csv':
                return self::TYPE_CSV;
                break;

            case 'text/plain':
            default:
                $tmpType = $this->testXML(self::TYPE_UNKNOWN);
                if ($tmpType != self::TYPE_UNKNOWN) {
                    return $tmpType;
                }

                return self::TYPE_CSV;
        }
    }

    protected function testXML($default = self::TYPE_UNKNOWN)
    {
        $resultType = $default;
        $iteration = 0;

        $reader = new XMLReader;
        $reader->open($this->filename, null, LIBXML_NOERROR | LIBXML_NOWARNING | 1);

        try {
            while ($reader->read() && $iteration++ < self::MAX_XML_ITERATION) {
                if ($reader->nodeType == XMLReader::ELEMENT) {
                    if (in_array($reader->name, self::YANDEX_XML_ELEMENTS_ARRAY)) {
                        $resultType = self::TYPE_XML_YANDEX;
                        break;
                    }

                    if (in_array($reader->name, self::GOOGLE_XML_ELEMENTS_ARRAY)) {
                        $resultType = self::TYPE_XML_GOOGLE;
                        break;
                    }
                }
            }
        } catch (\Exception $e) {
            if (strpos($e->getMessage(), 'input conversion failed')) {
                $this->deleteEncodingFromFile($this->filename);

                if (!$this->isTryingWithoutEncoding) {
                    $this->isTryingWithoutEncoding = true;

                    return $this->testXML(self::TYPE_XML_GOOGLE);
                }
            } else {
                return self::TYPE_CSV;
            }
        }

        $reader->close();

        return $resultType;
    }

    protected function deleteEncodingFromFile($filename)
    {
        $handle = fopen($filename, 'c+');

        fseek($handle, 0);
        $data = fread($handle, 1000);

        preg_match('/encoding=".{3,}"/', $data, $result);

        if (count($result)) {
            $replaceFrom = $result[0];
            $replaceFor = '';

            for ($i = 0; $i < strlen($replaceFrom); $i++) {
                $replaceFor .= ' ';
            }

            $data = str_replace($replaceFrom, $replaceFor, $data);

            fseek($handle, 0);
            fwrite($handle, $data, 1000);
        }

        fclose($handle);
    }
}
