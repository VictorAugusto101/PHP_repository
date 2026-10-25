<?php
session_start();

if (!isset($_SESSION['cpf'])) {
    header('Location: index.php');
    exit;
}

include("conexao.php");

$filme = $_POST['filme'];

if ($filme == ''){
    die('digite o filme!');
}

$sql = "DELETE FROM filmes WHERE filme = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die('Falha ao preparar o SQL: ' . $conn->error);
}

$stmt->bind_param("i", $filme);

if ($stmt->execute()) {
    header('Location: cadastroFilmes.php');
    exit;
} else {
    echo 'Erro ao excluir: ' . $stmt->error;
}
?>
