<?php
include "quadrado.php"; // O processamento e a lógica de pesquisa estão no quadrado.php

include "../cabecalho.php"; // Inclui o cabeçalho

$acao = "Atualizar";
?>

<div class="container mt-5">
    <h2 class="text-center mb-4"><?= $acao ?> Quadrado</h2>

    <!-- Formulário -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php include "form.php"; // Inclui o formulário para editar os dados do quadrado ?>
        </div>
    </div>

    <!-- Exibição do Quadrado com realce -->
    <div class="row mt-5">
        <!-- Exibição dos cálculos geométricos -->
        <div class="col-md-6">
            <h4 class="text-center">Desenvolvimento dos Cálculos</h4>
            <div class="border p-4 rounded">
                <!-- Cálculo da Área -->
                <h5 class="mb-3">Cálculo da Área</h5>
                <p><?= $quadrado->desenvolverCalculoArea() // Apresenta o cálculo da área ?></p>
                
                <!-- Cálculo do Perímetro -->
                <h5 class="mb-3">Cálculo do Perímetro</h5>
                <p><?= $quadrado->desenvolverCalculoPerimetro() // Apresenta o cálculo do perímetro ?></p>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <h4>Visualização do Quadrado</h4>
            <div class="d-flex justify-content-center align-items-center border rounded p-4" style="height: 100%;">
                <?= $quadrado->desenhar() // Chama o método desenhar do quadrado ?>
            </div>
        </div>
    </div>
</div>

<?php
include "../rodape.php"; // Inclui o rodapé
?>
