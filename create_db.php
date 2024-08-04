<?php
try {
    // Cria uma nova conexão com o banco de dados SQLite
    $db = new PDO('sqlite:advp.db');

    // Define o modo de erro do PDO para exceção
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria a tabela de membros
    $db->exec("CREATE TABLE IF NOT EXISTS membros (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE,
        senha TEXT NOT NULL,
        tipo TEXT NOT NULL DEFAULT 'usuario'
    )");

    // Cria a tabela de eventos
    $db->exec("CREATE TABLE IF NOT EXISTS eventos (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        data TEXT NOT NULL
    )");

    echo "Banco de dados e tabelas criados com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao criar banco de dados: " . $e->getMessage();
}
?>
