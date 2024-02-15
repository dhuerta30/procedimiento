<?php

namespace App\Models;

use App\core\DB;

class UsuarioMenuModel
{
	protected $table;
    protected $id;

    public function __construct()
    {
        $this->table = 'usuario_menu';
        $this->id = 'id_usuario_menu';
    }

    public function Obtener_menu_por_id_usuario($id)
    {
       
        $pdomodel = DB::PDOModel();
		$query = "SELECT *
				FROM menu
				INNER JOIN usuario_menu ON menu.id_menu = usuario_menu.id_menu
				INNER JOIN usuario ON usuario_menu.id_usuario = usuario.id
				WHERE usuario_menu.id_usuario = :userId";

		$data = $pdomodel->executeQuery($query, [':userId' => $id]);
		return $data;
    }
}