<?php

namespace App\core;

class JsonResponse
{
    public static function setJsonHeader()
    {
        header('Content-Type: application/json');
    }
}
