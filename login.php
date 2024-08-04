<?php
session_start();

try {
    // Conecta ao banco de dados SQLite
    $db = new PDO('sqlite:advp.db');

    // Define o modo de erro do PDO para exceção
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtém os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o usuário existe
    $stmt = $db->prepare("SELECT * FROM membros WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Login bem-sucedido
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_tipo'] = $usuario['tipo'];
        header("Location: area_restrita.php");
    } else {
        echo "Email ou senha incorretos.";
    }
} catch (PDOException $e) {
    echo "Erro ao fazer login: " . $e->getMessage();
}
?>
