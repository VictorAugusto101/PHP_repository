<?php
    include("valida.php");
    include("conexao.php");

    $cpf = $_POST['cpf'];

    if($cpf == ''){
        die('digite o cpf');
    }

    $sql = "delete from usuarios 
                   where cpf=?";
    $stmt = $conn->prepare($sql);
    if(stmt){
        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        header("Location: cadastroUsuarios.php");
    }else{
        echo 'falha no sql';
    }
?>