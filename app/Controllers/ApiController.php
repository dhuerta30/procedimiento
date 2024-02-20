<?php

namespace App\Controllers;

use App\core\DB;
use App\core\Request;
use App\core\JsonResponse;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
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
            
            $data = array_merge($request->all(), $request->getContentFromJson());
            
            $email = $data['email'];
            $password = $data['password'];

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

    /*public function validarToken()
    {
        $jwt = "";
        if (isset($_SERVER["HTTP_AUTHORIZATION"])) {
            $authorizationHeader = $_SERVER["HTTP_AUTHORIZATION"];
            $bearerPrefix = 'Bearer ';

            if (strpos($authorizationHeader, $bearerPrefix) !== false) {
                $jwt = trim(substr($authorizationHeader, strlen($bearerPrefix)));
            }
        } else {
            $header = apache_request_headers();
            if (isset($header["Authorization"])) {
                $authorizationHeader = $header["Authorization"];
                $bearerPrefix = 'Bearer ';

                if (strpos($authorizationHeader, $bearerPrefix) !== false) {
                    $jwt = trim(substr($authorizationHeader, strlen($bearerPrefix)));
                }
            }
        }

        if (!empty($jwt)) {
            try {
                $decoded = JWT::decode($jwt, new Key($this->secretKey, 'HS256'));
                return true;
            } catch (\Firebase\JWT\ExpiredException $e) {
                return false;
            } catch (Exception $e) {
                return false;
            }
        }

        return false;
    }*/


    public function validarToken($token)
    {
        $usuario = new UserModel();
        $data = $usuario->select_userBy_token($token);
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

                $usuario = new UserModel();
                $data = $usuario->select_userBy_token($token);

                if ($data && !empty($token) && $this->validarToken($token)) {
                    echo json_encode(['data' => $data]);
                } else {
                    echo json_encode(['error' => 'Token inválido no tiene permisos para acceder a esta Api']);
                }
            }
        }
    }
}
