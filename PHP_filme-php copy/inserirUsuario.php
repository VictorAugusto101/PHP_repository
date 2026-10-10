<?php
session_start();

if (!isset($_SESSION['cpf'])) {
    header('Location: index.php');
    exit;
}

include("conexao.php");

$cpf = trim($_POST['cpf'] ?? '');
$senha = trim($_POST['senha'] ?? '');
$nome = trim($_POST['nome'] ?? '');
$cpfAnterior = trim($_POST['cpfAnterior'] ?? '');

if ($cpf === '') {
    die('Digite o CPF.');
}

if ($senha === '') {
    die('Digite a senha.');
}

if ($nome === '') {
    die('Digite o nome.');
}

if ($cpfAnterior === '') {
    die('CPF anterior não informado.');
}

$sql = "UPDATE usuarios SET cpf = ?, senha = ?, nome = ? WHERE cpf = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die('Falha no SQL: ' . $conn->error);
}

$stmt->bind_param("ssss", $cpf, $senha, $nome, $cpfAnterior);

if (!$stmt->execute()) {
    die('Erro ao atualizar usuário: ' . $stmt->error);
}

if ($_SESSION['cpf'] === $cpfAnterior) {
    $_SESSION['cpf'] = $cpf;
    $_SESSION['senha'] = $senha;
    $_SESSION['nome'] = $nome;
}

header('Location: principal.php');
exit;
?>
