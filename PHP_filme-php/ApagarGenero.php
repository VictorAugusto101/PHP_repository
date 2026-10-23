<?php
include("conexao.php");

$genero = $_POST['genero'];

if ($genero == ''){
    die('digite a genero!');
}

$sql = "delete from genero where genero = ?";
$stmt = $conn->prepare($sql);
if($stmt){
    $stmt->bind_param("s",$genero);
    $stmt->execute();
    header('Location: principal.php');
}else{
    echo 'falha no sql';
}
?>