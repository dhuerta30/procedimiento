<?php 

namespace App\Models;

use App\core\DB;

class UserModel
{
	private $email;
	private $table;
	private $token_api;

	public function __construct()
	{
		$this->email = "email";
		$this->table = "usuario";
		$this->token_api = "token_api";
	}

    public function select_users()
	{
		$pdomodel = DB::PDOModel();
		$query = $pdomodel->select($this->table);
		return $query;
	}

	public function select_userBy_email($email){
		$pdomodel = DB::PDOModel();
		$pdomodel->where($this->email, $email);
		$data = $pdomodel->select($this->table);
		return $data;
	}

	public function update_userBy_email($email, $data = array()){
		$pdomodel = DB::PDOModel();
		$pdomodel->where($this->email, $email);
		$pdomodel->update($this->table, $data);
		return $pdomodel;
	}
}