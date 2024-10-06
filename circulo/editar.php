<?php
require_once("circulo.php"); // O processamento e a lógica de pesquisa estão no circulo.php

include "../cabecalho.php"; // Inclui o cabeçalho

$acao = "Atualizar";
?>

<div class="container mt-5">
    <h2 class="text-center mb-4"><?= $acao ?> Círculo</h2>

    <!-- Formulário de edição de círculo -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php include "form.php"; // Inclui o formulário para editar os dados do círculo ?>
        </div>
    </div>

    <!-- Exibição do círculo com realce -->
    <div class="row mt-5">
        <div class="col-md-6">
            <h4 class="text-center">Desenvolvimento dos Cálculos</h4>
            <div class="border p-4 rounded">
                <!-- Cálculo da Área -->
                <h5 class="mb-3">Cálculo da Área</h5>
                <p><?= $circulo->desenvolverCalculoArea() // Mostra o cálculo detalhado da área ?></p>
                
                <!-- Cálculo do Perímetro -->
                <h5 class="mt-5 mb-3">Cálculo do Perímetro</h5>
                <p><?= $circulo->desenvolverCalculoPerimetro() // Mostra o cálculo detalhado do perímetro ?></p>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <h4>Visualização do Círculo</h4>
            <div class="d-flex justify-content-center align-items-center border rounded p-4" style="height: 100%;">
                <?= $circulo->desenhar() // Chama o método desenhar do círculo ?>
            </div>
        </div>

    <!-- Exibição dos cálculos geométricos -->
        
    </div>
</div>

<?php
include "../rodape.php"; // Inclui o rodapé
?>
