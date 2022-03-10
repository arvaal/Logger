<?php

namespace Logger\Handlers;

use Logger\Logger;

class FileHandler extends Logger {

    protected $is_enabled = true;
    protected $level_array = [];
    protected $filename = '';
    protected $levels = [];
    protected $level;
    protected $formatter = [];
    protected $template = '';
    protected $date_format = '';

    public function __construct($data) {

        foreach ($data as $key => $item) {

            if ($key == 'levels') {
                foreach ($item as $level) {
                    $this->level_array[] = $level['level'];
                }
            }

            if (property_exists($this, $key)) {
                $this->{$key} = $item;
            }
        }
    }

    public function log($level, $message) {

        $this->level = $level;

        if (!$this->is_enabled) {
            return;
        }

        if (in_array($level['level'], $this->level_array) || empty($this->level_array)) {

            $date = date($this->formatter->format['date_format']);

            $log_text = trim(strtr($this->formatter->format['template'], [
                '%date%' => $date,
                '%level_code%' => $level['code'],
                '%level%' => $level['level'],
                '%message%' => $message,
            ]));

            file_put_contents($this->filename, $log_text . PHP_EOL, FILE_APPEND);

            if (isset($level['syslog'])) {
                openlog("syslog", LOG_PERROR, LOG_USER);

                syslog(LOG_DEBUG, $log_text);

                closelog();
            }
        }
    }

    public function info($message) {
        $this->log($this->level, $message);
    }

    public function setIsEnabled($bool) {
        $this->is_enabled = $bool;
    }

}
