<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

$nome = $_SESSION['usuario_nome'];
$tipo = $_SESSION['usuario_tipo'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Restrita - ADVP</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</h1>
        <nav>
            <ul>
                <li><a href="index.html">Início</a></li>
                <li><a href="cadastro.html">Cadastro de Membros</a></li>
                <li><a href="eventos.html">Eventos</a></li>
                <li><a href="dados.html">Dados do Membro</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Área Restrita</h2>
        <p>Você está logado como <?php echo htmlspecialchars($tipo); ?>.</p>
        <!-- Conteúdo exclusivo para membros -->
    </main>
    <footer>
        <p>&copy; 2024 ADVP. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
