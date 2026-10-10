<?php
session_start();

if (!isset($_SESSION['cpf'])) {
    header('Location: index.php');
    exit;
}

include("conexao.php");

$cpf = $_GET['cpf'] ?? '';

if ($cpf === '') {
    header('Location: principal.php');
    exit;
}

$stmt = $conn->prepare("SELECT nome, cpf, senha FROM usuarios WHERE cpf = ?");
$stmt->bind_param("s", $cpf);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    die("Usuário não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar usuário</title>
    <link rel="stylesheet" href="desingLogin.css">
</head>
<body>
<header>
    <h2>Atualizar usuário</h2>
</header>
<div class="container">
    <div id="logo">
        <h1>Atualizar usuário</h1>
    </div>
    <div id="formulario">
        <form method="post" action="inserirUsuario.php">
            <input type="hidden" name="cpfAnterior" value="<?= htmlspecialchars($usuario['cpf']) ?>">
            <label for="nome">NOME</label>
            <input id="nome" type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
            <label for="cpf">CPF</label>
            <input id="cpf" type="text" name="cpf" value="<?= htmlspecialchars($usuario['cpf']) ?>" required>
            <label for="senha">SENHA</label>
            <input id="senha" type="password" name="senha" value="<?= htmlspecialchars($usuario['senha']) ?>" required>
            <input type="submit" value="UPDATE">
        </form>
        <h3><a href="principal.php">Voltar</a></h3>
    </div>
</div>
</body>
</html>
