<?php

        namespace App\Models;

        use App\core\DB;
        
        class UsuarioSubMenuModelModel
        {
            private $table;

            public function __construct()
            {
                $this->table = '';
            }

            public function mi_metodo($data = array())
            {
                $pdomodel = DB::PDOModel();
                $pdomodel->insert($this->table, $data);
                return $pdomodel;
            }

        }