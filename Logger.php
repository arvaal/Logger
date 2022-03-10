<?php

namespace Logger;

class Logger {

    protected $file_handler = [];
    protected $level;

    public function addHandler($FileHandler) {
        $this->file_handler[] = $FileHandler;
    }

    public function log($level, $message) {
        
        $this->level = $level;
                
        foreach ($this->file_handler as $handler) {
                        
            if (!$handler instanceof Logger || !$handler->is_enabled) {
                continue;
            }
                        
            $handler->log($level, $message);
        }
    }

    public function error($message) {
        $this->log($this->level, $message);
    }

    public function info($message) {
        $this->log($this->level, $message);
    }

    public function debug($message) {
        $this->log($this->level, $message);
    }

    public function notice($message) {
        $this->log($this->level, $message);
    }

}
