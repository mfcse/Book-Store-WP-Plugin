<?php

namespace Book\Store\Traits;

trait Form_Error
{

    public $errors = [];
    public function has_error($key)
    {
        return isset($this->errors[$key]) ? true : false;
    }
    public function get_error($key)
    {
        return isset($this->errors[$key]) ? $this->errors[$key] : false;
    }
}