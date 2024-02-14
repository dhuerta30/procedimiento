<?php

namespace App\core;

class Decodejson
{
    public static function getContentFromJson()
    {
        $json = file_get_contents('php://input');
        return json_decode($json);
    }
}
