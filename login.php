<?php
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

if ($cpf == ''){
    echo 'CPF vazio, digite o CPF';
}

if ($senha == ''){
    echo 'senha vazia, digite a senha';
}

if($cpf == '123' && $senha == '123'){
    session_start();
    $_SESSION['cpf'] = $cpf;
    $_SESSION['senha'] = $senha;
    $_SESSION['nome'] = 'Victor';
    header('Location: principal.php');

}else{
    echo 'senha errrada';
}
?>