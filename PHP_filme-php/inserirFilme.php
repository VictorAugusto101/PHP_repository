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

$nome   = trim($_POST['nome'] ?? '');
$ano    = filter_var($_POST['ano'] ?? '', FILTER_VALIDATE_INT);
$genero = filter_var($_POST['genero'] ?? '', FILTER_VALIDATE_INT);

if ($nome === '' || $ano === false || $genero === false) {
    die('Preencha todos os campos corretamente.');
}

// a coluna "filme" é AUTO_INCREMENT, então não entra no INSERT
$stmt = $conn->prepare("INSERT INTO filmes (nome, ano, genero) VALUES (?, ?, ?)");

if (!$stmt) {
    die('Falha ao preparar o SQL: ' . $conn->error);
}

// s = nome, i = ano, i = genero
$stmt->bind_param("sii", $nome, $ano, $genero);

if ($stmt->execute()) {
    header('Location: cadastroFilmes.php');
    exit;
} else {
    echo 'Erro ao cadastrar: ' . $stmt->error;
}
?>