<?php

namespace Logger\Formatters;

class LineFormatter {

    public $format = [];

    private const DEFAULT_TEMPLATE = '%date%  %level_code%  %level%  %message%';
    private const DEFAULT_DATE_FORMAT = 'Y-m-d H:i:s';

    public function __construct($pattern = self::DEFAULT_TEMPLATE, $date_format = self::DEFAULT_DATE_FORMAT) {

        $this->setFormat([
            'template' => $this->templateAdapter($pattern),
            'date_format' => $date_format
        ]);
    }

    public function setFormat($data) {
        $this->format = $data;
    }

    public function getFormat() {
        return $this->format;
    }

    private function templateAdapter($pattern) {
        return trim($pattern);
    }

}
