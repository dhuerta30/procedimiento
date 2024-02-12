<?php

namespace App\Controllers;

use App\core\DB;
use App\core\Request;
use App\core\JsonResponse;
use Firebase\JWT\JWT;

class ApiController
{
    private $secretKey;
    public $json;

    public function __construct()
	{
        $this->json = file_get_contents('php://input');
        $this->secretKey = $_ENV['CSRF_SECRET'];
	}

    public function generarToken()
    {
        JsonResponse::setJsonHeader();

        $request = new Request();

        if ($request->getMethod() === 'POST') {
            $json = $this->json;
            $content = json_decode($json);

            if (isset($content)) {
                $email = $content->email;
                $password = $content->password;

                $pdomodel = DB::PDOModel();
                $data = $pdomodel->where("email", $email)->select("usuario");

                if (password_verify($password, $data[0]["password"])) {
                    
                    $tokenData = [
                        'id' => $data[0]["id"],
                        'email' => $data[0]["email"],
                        'timestamp' => time(),
                    ];

                    $token = JWT::encode($tokenData, $this->secretKey, 'HS256');

                    $pdomodel->where("email", $data[0]["email"])->update("usuario", array("token_api" => $token));
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
            $json = $this->json;
            $content = json_decode($json);

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
