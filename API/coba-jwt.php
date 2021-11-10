<?php
require '../vendor/autoload.php';
use Firebase\JWT\JWT;

$key = "example_key";
$payload = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);
$payload['id'] = 'raihan'; 
$jwt = JWT::encode($payload, $key);
print_r($jwt);

$decoded = JWT::decode($jwt, $key, array('HS256'));
print_r($decoded);
echo $decoded->{'id'};
?>