<?php
session_start();

if (!isset($_SESSION['cpf'])) {
    header('Location: index.php');
    exit;
}

include("conexao.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Requisição inválida.');
}

$id     = filter_var($_POST['filme'] ?? '', FILTER_VALIDATE_INT);
$nome   = trim($_POST['nome'] ?? '');
$ano    = filter_var($_POST['ano'] ?? '', FILTER_VALIDATE_INT);
$genero = filter_var($_POST['genero'] ?? '', FILTER_VALIDATE_INT);

if ($id === false || $nome === '' || $ano === false || $genero === false) {
    die('Preencha todos os campos corretamente.');
}

$stmt = $conn->prepare("UPDATE filmes SET nome = ?, ano = ?, genero = ? WHERE filme = ?");

if (!$stmt) {
    die('Falha ao preparar o SQL: ' . $conn->error);
}

// s = nome, i = ano, i = genero, i = filme
$stmt->bind_param("siii", $nome, $ano, $genero, $id);

if ($stmt->execute()) {
    header('Location: cadastroFilmes.php');
    exit;
} else {
    echo 'Erro ao atualizar: ' . $stmt->error;
}
?>