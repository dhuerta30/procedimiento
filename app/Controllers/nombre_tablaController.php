<?php

        namespace App\Controllers;

        use App\core\DB;

        class nombre_tablaController
        {
            public function index()
            {
                // Implementa la lógica del controlador aquí
                $pdocrud = DB::PDOCrud();
                echo $pdocrud->dbTable('nombre_tabla')->render();
            }
        }