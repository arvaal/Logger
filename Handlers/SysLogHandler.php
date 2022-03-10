<?php

namespace Logger\Handlers;

use Logger\Logger;

class SysLogHandler extends Logger {
    protected $is_enabled = true;
    
    public function setIsEnabled($bool) {
        $this->is_enabled = $bool;
    }
}
