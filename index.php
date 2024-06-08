<?php
require_once 'connection.php';

$stmt = $pdo->prepare("SELECT * FROM users_token ORDER BY id DESC LIMIT 1");
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    exit('Precisa gerar o token');
}

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://www.bling.com.br/Api/v3/produtos");

// HTTP headers
$headers = [
    "Authorization: Bearer {$user['access_token']}"
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

// Verifica erros
if(curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    // Resposta
    echo $response;
}

curl_close($ch);
