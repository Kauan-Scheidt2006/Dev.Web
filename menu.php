<?php
session_start(); // Inicia a sessão para gerenciar variáveis de sessão
?>
<!-- Link para o arquivo CSS do Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container">
    <!-- Navegação principal do site -->
    <nav class="navbar navbar-expand">
        <ul class="navbar-nav">
            <li class="nav-link">
                <!-- Link para a página principal -->
                <a href="index.php">Principal</a>
            </li>

            <li class="nav-link">
                <!-- Link para a página de cadastro -->
                <a href="create.php">Cadastro</a>
            </li>
        </ul>
    </nav>
</div>
