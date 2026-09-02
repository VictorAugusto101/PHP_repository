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

>>>>>>> 18e51082b2c87f51fd192883c994f1d6d0ab2d9f
?>