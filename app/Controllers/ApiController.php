<?php

namespace App\Controllers;

use App\core\DB;
use App\core\Request;
use App\core\JsonResponse;
use Firebase\JWT\JWT;
use App\Models\UserModel;
use App\core\Decodejson;

class ApiController
{
    private $secretKey;

    public function __construct()
	{
        $this->secretKey = $_ENV['CSRF_SECRET'];
	}

    public function generarToken()
    {
        JsonResponse::setJsonHeader();

        $request = new Request();

        if ($request->getMethod() === 'POST') {
            
            $content = Decodejson::getContentFromJson();

            if (isset($content)) {
                $email = $content->email;
                $password = $content->password;

                $usuario = new UserModel();
                $data = $usuario->select_userBy_email($email);

                if (password_verify($password, $data[0]["password"])) {
                    
                    $tokenData = [
                        'id' => $data[0]["id"],
                        'email' => $data[0]["email"],
                        'timestamp' => time(),
                    ];

                    $token = JWT::encode($tokenData, $this->secretKey, 'HS256');

                    $usuario->update_userBy_email($data[0]["email"], array("token_api" => $token));
                    echo json_encode(['token' => $token]);
                } else {
                    echo json_encode(['error' => 'No tiene permisos para acceder a esta Api']);
                }
            }
        }
    }

    public function validarToken($token)
    {
        $pdomodel = DB::PDOModel();
        $data = $pdomodel->where("token_api", $token)->select("usuario");
        return ($data) ? true : false;
    }

    public function listar()
    {
        JsonResponse::setJsonHeader();

        $request = new Request();

        if ($request->getMethod() === 'GET') {
           
            $content = Decodejson::getContentFromJson();

            if (isset($content)) {
                $token = $content->token;

                $pdomodel = DB::PDOModel();
                $data = $pdomodel->where("token_api", $token)->select("usuario");

                if ($data && !empty($token) && $this->validarToken($token)) {
                    echo json_encode(['data' => $data]);
                } else {
                    echo json_encode(['error' => 'Token inválido o no tiene permisos para acceder a esta Api']);
                }
            }
        }
    }
}
