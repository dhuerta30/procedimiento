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
        $params1 = $request->get('user'); // use el metodo $_GET['user'];

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
