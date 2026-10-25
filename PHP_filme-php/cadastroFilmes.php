<?php
session_start();

if (!isset($_SESSION['cpf'])) {
    header('Location: index.php');
    exit;
}

include("conexao.php");

$sql = "SELECT f.filme, f.nome, f.ano, g.descricao AS genero
        FROM filmes f
        LEFT JOIN generos g ON g.genero = f.genero
        ORDER BY f.nome";
$result = $conn->query($sql);

if (!$result) {
    die("Erro ao consultar filmes: " . $conn->error);
}

$resGeneros = $conn->query("SELECT genero, descricao FROM generos WHERE status = 1 ORDER BY descricao");

if (!$resGeneros) {
    die("Erro ao consultar gêneros: " . $conn->error);
}

$generos = $resGeneros->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #f3f4f6; color: #1f2937; }
        header { background: #1f2937; color: white; padding: 18px 30px; display: flex; justify-content: space-between; align-items: center; gap: 20px; }
        header h2 { margin: 0; }
        header div { display: flex; align-items: center; gap: 15px; }
        header a { color: white; text-decoration: none; background: #dc2626; padding: 8px 14px; border-radius: 5px; }
        main { width: min(1100px, 94%); margin: 35px auto; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,.1); }
        #cadastro {display: flex; justify-content: space-between; align-items: center;}
        #cadastro button {color: white; text-decoration: none; border: 1px rgba(0, 0, 0, 0); background: #2563eb; padding: 8px 14px; border-radius: 5px; cursor: pointer; }
        #cadastro button:hover {background: white; color: #2563eb; border-color: rgba(0, 107, 230, 0.47); box-shadow: 1px 1px 15px 4px rgba(12, 125, 255, 0.61)}
        h1 { margin-top: 0; }
        .tabela { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 650px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #2563eb; color: white; }
        .acoes { display: flex; gap: 8px; }
        .btn { border: 0; border-radius: 5px; padding: 8px 12px; color: white; text-decoration: none; cursor: pointer; font-size: 14px; }
        .update { background: #2563eb; }
        .delete { background: #dc2626; }
        .salvar { background: #16a34a; }
        .cancelar { background: #6b7280; }
        #linhaCadastro { background: #eff6ff; }
        #linhaCadastro input, #linhaCadastro select { width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 5px; font-size: 14px; }
        .vazio { text-align: center; padding: 20px; }
        @media (max-width: 640px) {
            header { flex-direction: column; align-items: flex-start; }
            main { padding: 15px; }
        }
    </style>
</head>
<body>
<header>
    <h2>Sistema de Filmes</h2>
    <div id="titulo">
        <span>Olá, <?= htmlspecialchars($_SESSION['nome'] ?? '') ?></span>
        <a href="sair.php">SAIR</a>
        <a href="principal.php">PRINCIPAL</a>
    </div>
</header>

<main>

    <div id="cadastro">
        <h1>Filmes cadastrados</h1>
        <button type="button" id="btnCadastrar">Cadastrar filme</button>
    </div>

    <!-- Formulário fica fora da tabela; os campos da linha se ligam a ele pelo atributo form="formCadastro" -->
    <form id="formCadastro" method="post" action="inserirFilme.php"></form>

    <div class="tabela">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ano</th>
                    <th>Gênero</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Linha de cadastro: começa escondida -->
                <tr id="linhaCadastro" hidden>
                    <td>
                        <input type="text" name="nome" id="novoNome" form="formCadastro" placeholder="Nome do filme" maxlength="100" required>
                    </td>
                    <td>
                        <input type="number" name="ano" form="formCadastro" placeholder="Ano" min="1888" max="2100" required>
                    </td>
                    <td>
                        <select name="genero" form="formCadastro" required>
                            <option value="" disabled selected>Selecione...</option>
                            <?php foreach ($generos as $g): ?>
                                <option value="<?= (int)$g['genero'] ?>"><?= htmlspecialchars($g['descricao']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <div class="acoes">
                            <button class="btn salvar" type="submit" form="formCadastro">SALVAR</button>
                            <button class="btn cancelar" type="button" id="btnCancelar">CANCELAR</button>
                        </div>
                    </td>
                </tr>

                <?php if ($result->num_rows > 0): ?>
                    <?php while ($filme = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($filme['nome']) ?></td>
                            <td><?= htmlspecialchars($filme['ano']) ?></td>
                            <td><?= htmlspecialchars($filme['genero'] ?? '') ?></td>
                            <td>
                                <div class="acoes">
                                    <a class="btn update" href="atualizarFilme.php?filme=<?= urlencode($filme['filme']) ?>">UPDATE</a>
                                    <form method="post" action="apagarFilme.php" onsubmit="return confirm('Deseja realmente excluir este filme?');">
                                        <input type="hidden" name="filme" value="<?= htmlspecialchars($filme['filme']) ?>">
                                        <button class="btn delete" type="submit">DELETE</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td class="vazio" colspan="4">Nenhum filme cadastrado.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<script>
    const linha = document.getElementById('linhaCadastro');
    const form = document.getElementById('formCadastro');

    document.getElementById('btnCadastrar').addEventListener('click', function () {
        linha.hidden = false;
        document.getElementById('novoNome').focus();
    });

    document.getElementById('btnCancelar').addEventListener('click', function () {
        form.reset();
        linha.hidden = true;
    });
</script>
</body>
</html>