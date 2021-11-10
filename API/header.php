<?php
    require '../vendor/autoload.php';
    use Firebase\JWT\JWT;
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Content-Type: application/json; charset=utf-8");
	include "../koneksi.php";
    $key = "example_key";
    function encodeToken($payload){
        global $key;
        $jwt = JWT::encode($payload, $key);
        return $jwt;
    };
    function decodedToken(){
        global $key;
        $headers = apache_request_headers();
        if(isset($headers['authorization'])){
            $token = $headers['authorization'];
            $token = explode(' ',$token);
            $payload = (array) JWT::decode($token[1], $key,array('HS256'));
        }else if(isset($headers['Authorization'])){
            $token = $headers['Authorization'];
            $token = explode(' ',$token);
            $payload = (array) JWT::decode($token[1], $key,array('HS256'));
        }else{
            $payload = array();
        }
        return $payload;
    };
    $TOKEN = decodedToken();
?>