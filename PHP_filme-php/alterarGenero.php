<?php
include ("conexao.php");

$genero = $_POST['genero'];
$status = $_POST['status'];
$descricao = $_POST['descricao'];

if ($genero == ''){
    die('digite a genero!');
}

if ($status == ''){
    die('digite a status!');
}

if ($descricao == ''){
    die('digite a descricao!');
}

$sql = "update genero set status = ?,
                          descricao = ? 
                    where genero = ?";
    
$stmt = $conn->prepare($sql);
if($stmt){
    $stmt->bind_param("isi",$status,$descricao,$genero);
    $stmt->execute();
    header('Location: principal.php');
}else{
    echo 'falha no sql';
}
?>