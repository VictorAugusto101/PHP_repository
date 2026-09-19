<?php

include("conexao.php");


include("conexao.php");

$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

if ($cpf == ''){
    die('digite o cpf');
    die('digite o cpf');
}

if ($senha == ''){
    die('digite a senha');
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
    echo 'falha no sql';
}
?>