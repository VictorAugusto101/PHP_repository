<<<<<<< HEAD
<?php

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "vitu";

    $conn = new mysqli($servidor,$usuario,$senha,$dbname);
    if($conn->connect_error){
        die("Falha na conexao ".$conn->connect_error);
    }

=======
<?php

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "vitu";

    $conn = new mysqli($servidor,$usuario,$senha,$dbname);
    if($conn->connect_error){
        die("Falha na conexao ".$conn->connect_error);
    }

>>>>>>> 080e34dccb84c1f6b630433bff5d8391b2444e29
?>