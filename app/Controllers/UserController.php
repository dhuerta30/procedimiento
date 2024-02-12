<?php

namespace App\Controllers;

class UserController
{
    public function index($params)
    {
        $params1 = isset($params[0]) ? $params[0] : null;
        /*$params2 = isset($params[1]) ? $params[1] : null;
        $params3 = isset($params[2]) ? $params[2] : null;
        $params4 = isset($params[3]) ? $params[3] : null;
        $params5 = isset($params[4]) ? $params[4] : null;*/

        $pdocrud = DB::PDOCrud();
        if(isset($params1)){
            $pdocrud->where("id", $params1, "=");
        }
        $render = $pdocrud->dbTable("usuario")->render();

        View::render('index', ['render' => $render]);
    }

    public function edit()
    {       
        View::render('product');
        
    }
}
