<?php
session_start();

if (!isset($_SESSION['cpf'])) {
    header('Location: index.php');
    exit;
}

include("conexao.php");

$id = filter_var($_GET['filme'] ?? '', FILTER_VALIDATE_INT);

if ($id === false) {
    die("Filme não informado.");
}

$stmt = $conn->prepare("SELECT filme, nome, ano, genero FROM filmes WHERE filme = ?");

if (!$stmt) {
    die("Falha ao preparar o SQL: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$filme = $result->fetch_assoc();

if (!$filme) {
    die("Filme não encontrado.");
}

$generos = $conn->query("SELECT genero, descricao FROM generos WHERE status = 1 ORDER BY descricao");

if (!$generos) {
    die("Erro ao consultar gêneros: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar filme</title>
    <link rel="stylesheet" href="desingLogin.css">
</head>
<body>
<header>
    <h2>Atualizar filme</h2>
</header>
<div class="container">
    <div id="logo">
        <h1>Atualizar filme</h1>
    </div>
    <div id="formulario">
        <form method="post" action="salvarFilme.php">
            <input type="hidden" name="filme" value="<?= (int)$filme['filme'] ?>">

            <label for="nome">NOME</label>
            <input id="nome" type="text" name="nome" value="<?= htmlspecialchars($filme['nome']) ?>" required>

            <label for="ano">ANO</label>
            <input id="ano" type="number" name="ano" value="<?= (int)$filme['ano'] ?>" required>

            <label for="genero">Gênero do filme:</label>
            <select name="genero" id="genero" required>
                <option value="" disabled>Selecione...</option>
                <?php while ($g = $generos->fetch_assoc()): ?>
                    <option value="<?= (int)$g['genero'] ?>"
                        <?= (int)$filme['genero'] === (int)$g['genero'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($g['descricao']) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="UPDATE">
        </form>
        <h3><a href="cadastroFilmes.php">Voltar</a></h3>
    </div>
</div>
</body>
</html>