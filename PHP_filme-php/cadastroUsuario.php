<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="desingLogin.css">
    <title>Cadastro</title>
</head>
<body>
<header>
    <h2>Cadastro</h2>
</header>
<div class="container">
    <div id="logo">
        <h1>Cadastro de Usuário</h1>
    </div>
    <div id="formulario">
        <form method="post" action="sistemaCadastro.php">
            <label for="nome">NOME</label>
            <input id="nome" type="text" name="nome" required>
            <label for="cpf">CPF</label>
            <input id="cpf" type="text" name="cpf" required>
            <label for="senha">SENHA</label>
            <input id="senha" type="password" name="senha" required>
            <input type="submit" value="CADASTRAR">
        </form>
        <h3><a href="index.php">Login</a></h3>
    </div>
</div>
</body>
</html>
