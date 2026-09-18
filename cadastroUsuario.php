<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="desingLogin.css">
    <title>Document</title>
</head>
<body>
    <header>
        <h2>Cadastro</h2>
    </header>
        <div class="container">
            <div id="logo">
                <h1>Login de Usuario</h1>
            </div>

            <div id="formulario">
                <form method="post" action="sistemaCadastro.php">
                    <label for="nome">NOME</label>
                    <input id="nome" type="text" name="nome">
                    <label for="cpf">CPF</label>
                    <input id="cpf" type="text" name="cpf">
                    <label for="senha">SENHA</label>
                    <input id="senha" type="password" name="senha">

                    <input type="submit" value="login">
                </form>
                <h3><a href="index.php">Login</a></h3>
            </div> 

        </div>
</body>
</html>