<<<<<<< HEAD
<?php

include("conexao.php");

$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

if ($cpf == ''){
    die('digite o cpf');
}

if ($senha == ''){
    die('digite a senha');
}

$sql = "select nome from usuarios where cpf = ? and senha = ?";
$stmt = $conn->prepare($sql);

if($stmt){
    $stmt->bind_param("ss",$cpf,$senha);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows >0){
        $row = $result->fetch_assoc();
        if($row['nome'] != ''){
            session_start();
            $_SESSION['cpf'] = $cpf;
            $_SESSION['senha'] = $senha;
            $_SESSION['nome'] = 'Victor';
            header('Location: principal.php');
        }else {
            echo 'usuario ou senha incorretos';
        }
    }else{
        echo 'usuario ou senha incorretos';
    }
}else{
    echo 'falha no sql';
}
?>
=======
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
>>>>>>> 080e34dccb84c1f6b630433bff5d8391b2444e29
