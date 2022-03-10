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
        var_dump($level);
        
        $this->level = $level;
        
        if (!$this->is_enabled) {
            return;
        }
        
        if (in_array($level['level'], $this->level_array) || empty($this->level_array)) {
            file_put_contents($this->filename, trim(strtr($this->formatter->format['template'], [
                '%date%' => date($this->formatter->format['date_format']),
                '%level_code%' => $level['code'],
                '%level%' => $level['level'],
                '%message%' => $message,
            ])) . PHP_EOL, FILE_APPEND);
        }
        
    }
    
    public function info($message) {
        $this->log($this->level, $message);
    }

    public function setIsEnabled($bool) {
        $this->is_enabled = $bool;
    }

}
