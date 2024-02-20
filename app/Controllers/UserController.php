<?php

namespace App\Controllers;

use App\core\DB;
use App\core\View;
use App\core\Request;

class UserController
{
    public function index()
    {
        $request = new Request();

        // Obtener un parámetro de la URL
        $parametro = $request->get(2);

        // Hacer algo con el parámetro
        echo "El valor del parámetro es: " . $parametro;
        die();

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
