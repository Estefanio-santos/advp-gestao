<?php
try {
    // Conecta ao banco de dados SQLite
    $db = new PDO('sqlite:advp.db');

    // Define o modo de erro do PDO para exceção
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Insere os dados no banco de dados
    $stmt = $db->prepare("INSERT INTO membros (nome, email, senha) VALUES (:nome, :email, :senha)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    echo "Cadastro realizado com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao cadastrar membro: " . $e->getMessage();
}
?>
