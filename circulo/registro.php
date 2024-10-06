<?php

include "circulo.php";
// Listar unidades para o formulário
$acao = "Registrar";
include "../cabecalho.php"; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4"><?= $acao ?> Círculo</h2>

    <!-- Formulário -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php include "form.php"; ?>
        </div>
    </div>
</div>

<?php include "../rodape.php"; ?>
