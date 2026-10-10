<?php
session_start();

if (!isset($_SESSION['cpf'])) {
    header('Location: index.php');
    exit;
}

include("conexao.php");

$cpf = trim($_POST['cpf'] ?? '');

if ($cpf === '') {
    die('Digite o CPF.');
}

if ($cpf === $_SESSION['cpf']) {
    die('Você não pode excluir o usuário que está conectado.');
}

$sql = "DELETE FROM usuarios WHERE cpf = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die('Falha no SQL: ' . $conn->error);
}

$stmt->bind_param("s", $cpf);

if (!$stmt->execute()) {
    die('Erro ao excluir usuário: ' . $stmt->error);
}

header("Location: principal.php");
exit;
?>
