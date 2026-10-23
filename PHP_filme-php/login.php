<?php
session_start();
include("conexao.php");

$cpf = trim($_POST['cpf'] ?? '');
$senha = trim($_POST['senha'] ?? '');

if ($cpf === '') {
    die('Digite o CPF.');
}

if ($senha === '') {
    die('Digite a senha.');
}

$sql = "SELECT nome FROM usuarios WHERE cpf = ? AND senha = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die('Falha no SQL: ' . $conn->error);
}

$stmt->bind_param("ss", $cpf, $senha);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    session_regenerate_id(true);
    $_SESSION['cpf'] = $cpf;
    $_SESSION['senha'] = $senha;
    $_SESSION['nome'] = $row['nome'];
    header('Location: principal.php');
    exit;
}

die('Usuário ou senha incorretos.');
?>
