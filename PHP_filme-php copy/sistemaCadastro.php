<?php
include("conexao.php");

$cpf = trim($_POST['cpf'] ?? '');
$senha = trim($_POST['senha'] ?? '');
$nome = trim($_POST['nome'] ?? '');

if ($cpf === '') {
    die('Digite o CPF.');
}

if ($senha === '') {
    die('Digite a senha.');
}

if ($nome === '') {
    die('Digite o nome.');
}

$sql = "INSERT INTO usuarios (nome, cpf, senha) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die('Falha no SQL: ' . $conn->error);
}

$stmt->bind_param("sss", $nome, $cpf, $senha);

if (!$stmt->execute()) {
    die('Erro ao cadastrar usuário: ' . $stmt->error);
}

header('Location: index.php');
exit;
?>
