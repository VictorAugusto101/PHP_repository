<?php

session_start();

echo 'Ola'.$_SESSION['nome'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>

    </header>
    <br>
    <a href="sair.php">SAIR</a>
    <table style=" width: 100%">
        <tr>
            <td>CPF</td>
            <td>senha</td>
            <td>NOME</td>
            <td></td>
        </tr>
    </table>
</body>
</html>
