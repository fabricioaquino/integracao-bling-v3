<?php
try {

    $pdo = new PDO('sqlite:data.sqlite');
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("CREATE TABLE IF NOT EXISTS users_token (
                    id INTEGER PRIMARY KEY, 
                    client_id TEXT, 
                    client_secret TEXT,
                    access_token TEXT,
                    refresh_token TEXT)");

} catch (PDOException $e) {
    echo $e->getMessage();
}
