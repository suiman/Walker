<?php

namespace Walker\Http;


class Environment
{
    private $data = array();

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function get($name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        } else {
            return null;
        }
    }

    public function getAll()
    {
        return $this->data;
    }

}