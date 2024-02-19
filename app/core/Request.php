<?php

namespace App\core;

class Request
{
    private $data = [];
    private $method;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];

        // Almacena los datos de $_POST si la solicitud es un POST
        if ($this->method === 'POST') {
            $this->data = $_POST;
        } else {
            // Almacena los datos de $_GET si la solicitud es un GET
            $this->data = $_GET;
        }
    }

    public function post($key)
    {
        // Solo permite obtener datos de $_POST si la solicitud es un POST
        return ($this->method === 'POST' && isset($this->data[$key])) ? $this->data[$key] : null;
    }

    public function get($key)
    {
        // Permite obtener datos de $_GET sin restricciones
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
