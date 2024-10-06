<?php
include "unidademedida.php";
include "../cabecalho.php";

$acao = "Registrar";
?>

<div class="container mt-5">
    <h2 class="text-center mb-4"><?= $acao ?> Unidade de Medida</h2>

    <!-- Formulário -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php include "form.php"; ?>
        </div>
    </div>
</div>

<?php
include "../rodape.php";
?>
