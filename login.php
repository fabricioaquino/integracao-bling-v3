<?php
require_once 'connection.php';

// Verificando se existe o parametro code 
if (!isset($_GET['code'])) {
    exit('Erro ao carregar url');
}

$code = $_GET['code']; // Validade de 1 min
$clientId = ''; // Preencher
$clientSecret = ''; // Preencher

if (is_null($clientId) || is_null($clientSecret)) {
    exit('clientId ou clientSecret não encontrados.');
}

// Fazendo uma solicitação HTTP POST
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://www.bling.com.br/Api/v3/oauth/token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => http_build_query([
        'grant_type' => 'authorization_code',
        'code' => $code,
    ]),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Basic ' . base64_encode("$clientId:$clientSecret")
    ),
));

$authResponse = curl_exec($curl);

curl_close($curl);

if (!$authResponse) {
    exit('Não foi possível autenticar no Bling.');
}

$authResponseContent = json_decode($authResponse, true);

$accessToken = isset($authResponseContent['access_token']) ? $authResponseContent['access_token'] : null;

if (is_null($accessToken)) {
    exit('Não foi possível obter o token de requisição.');
}

// Salvando no BD
$pdo->exec("INSERT INTO users_token (client_id, client_secret, access_token, refresh_token) 
            VALUES ('$clientId', '$clientSecret', '{$authResponseContent['access_token']}', '{$authResponseContent['refresh_token']}')");
    
echo "Token cadastrado!!!";

