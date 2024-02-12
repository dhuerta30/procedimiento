<?php 

namespace App\Models;

use App\core\DB;

class UserModel
{
    public function select_users()
	{
		$pdomodel = DB::PDOModel();
		$query = $pdomodel->select("usuario");
		return $query;
	}
}