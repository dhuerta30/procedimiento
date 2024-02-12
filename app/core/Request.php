<?php

namespace App\core;

class Request
{
    private $data = [];

    public function __construct()
    {
        // Almacena los datos de $_POST
        $this->data = ($_SERVER['REQUEST_METHOD'] === 'POST') ? $_POST : $_GET;
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function post($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function all()
    {
        return $this->data;
    }
}
