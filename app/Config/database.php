<?php
// Arquivo de configuração do banco de dados
require_once __DIR__ . '/config.php'; // Inclui o arquivo de configuração com as credenciais

function getDbConnection() {
    $dsn = 'pgsql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    $user = DB_USER;
    $password = DB_PASSWORD;
    
    try {
        // Cria a conexão PDO
        $conn = new PDO($dsn, $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo 'Erro de conexão: ' . $e->getMessage();
    }
}
