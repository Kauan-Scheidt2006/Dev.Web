<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "quadrado.php";
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <div class="container">        
        <nav class="navbar">

            <ul class="navbar-nav">
                <a href="../unidade/" class="nav-link"><h2>Navegar para Unidade</h2></a>

                <a href="index.php" class="nav-link"><h3>Listar Quadrado</h3></a>

                <a href="registro.php" class="nav-link"><h3>Registrar Quadrado</h3></a>
            </ul>
        </nav>
        <h3>
            <?= empty($_SESSION['mensagem']) ? "" : $_SESSION['mensagem']?>
        </h3>
        <br><br><br>