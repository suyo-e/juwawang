<?php

namespace App\Helpers\Macros;

use \GB2260\GB2260;

/**
 * Class Macros.
 */
class Cities extends GB2260
{
    public $data_reverse;

    public function __construct() 
    {
        parent::__construct();
        $this->data_reverse = array_flip($this->data);
    }

    public function get_code($name) {
        return isset($this->data_reverse[$name])?$this->data_reverse[$name]: null;
    }
}
