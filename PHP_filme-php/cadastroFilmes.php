<?php
session_start();

if (!isset($_SESSION['cpf'])) {
    header('Location: index.php');
    exit;
}

include("conexao.php");

$sql = "SELECT nome, ano, genero FROM filmes ORDER BY nome";
$result = $conn->query($sql);

if (!$result) {
    die("Erro ao consultar usuários: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #f3f4f6; color: #1f2937; }
        header { background: #1f2937; color: white; padding: 18px 30px; display: flex; justify-content: space-between; align-items: center; gap: 20px; }
        header h2 { margin: 0; }
        header div { display: flex; align-items: center; gap: 15px; }
        header a { color: white; text-decoration: none; background: #dc2626; padding: 8px 14px; border-radius: 5px; }
        main { width: min(1100px, 94%); margin: 35px auto; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,.1); }
        h1 { margin-top: 0; }
        .tabela { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 650px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #2563eb; color: white; }
        .acoes { display: flex; gap: 8px; }
        .btn { border: 0; border-radius: 5px; padding: 8px 12px; color: white; text-decoration: none; cursor: pointer; font-size: 14px; }
        .update { background: #2563eb; }
        .delete { background: #dc2626; }
        .vazio { text-align: center; padding: 20px; }
        @media (max-width: 640px) {
            header { flex-direction: column; align-items: flex-start; }
            main { padding: 15px; }
        }
    </style>
</head>
<body>
<header>
    <h2>Sistema de Usuários</h2>
    <div id="titulo">
        <span>Olá, <?= htmlspecialchars($_SESSION['nome']) ?></span>
        <a href="sair.php">SAIR</a>
        <a href="principal.php">PRINCIPAL</a>
    </div>
</header>

<main>
    <div>
        <h1>Usuários cadastrados</h1>
        <a href="cadastroFilmes.php">Cadastro</a>
    </div>
    <div class="tabela">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ano</th>
                    <th>Genero</th>
                 
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($filme = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($filme['nome']) ?></td>
                            <td><?= htmlspecialchars($filme['ano']) ?></td>
                            <td><?= htmlspecialchars($filme['genero']) ?></td>
                            <td>
                                <div class="acoes">
                                    <a class="btn update" href="atualizarFilme.php?filme=<?= urlencode($filme['filme']) ?>">UPDATE</a>
                                    <form method="post" action="apagarUsuario.php" onsubmit="return confirm('Deseja realmente excluir este usuário?');">
                                        <input type="hidden" name="filme" value="<?= htmlspecialchars($filme['filme']) ?>">
                                        <button class="btn delete" type="submit">DELETE</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td class="vazio" colspan="4">Nenhum usuário cadastrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>
