<?php
include "triangulo.php"; // O processamento e a lógica de pesquisa estão no triangulo.php
include "../cabecalho.php"; // Inclui o cabeçalho

$acao = "Atualizar";
?>

<div class="container mt-5">
    <h2 class="text-center mb-4"><?= $acao ?> Triângulo</h2>

    <!-- Formulário -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php include "form.php"; // Inclui o formulário para editar os dados do triângulo ?>
        </div>
    </div>

    <!-- Exibição do Triângulo com realce -->
    <?php if (!empty($triangulo)) { ?>
        <div class="row justify-content-center mt-5">
            <!-- Exibição dos cálculos geométricos -->
            <div class="col-md-6">
                <h4 class="text-center">Desenvolvimento dos Cálculos</h4>
                <div class="border p-4 rounded">
                    <!-- Cálculo da Área -->
                    <h5 class="mb-3">Cálculo da Área</h5>
                    <p><?= $triangulo->desenvolverCalculoArea() // Apresenta o cálculo da área ?></p>
                    
                    <!-- Cálculo do Perímetro -->
                    <h5 class="mb-3">Cálculo do Perímetro</h5>
                    <p><?= $triangulo->desenvolverCalculoPerimetro() // Apresenta o cálculo do perímetro ?></p>
                </div>
            </div>

            <div class="col-md-6 text-center">
                <h4>Visualização do Triângulo</h4>
                <div class="d-flex justify-content-center align-items-center border rounded p-4" style="height: 100%;">
                    <?= $triangulo->desenhar() // Chama o método desenhar do triângulo ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php
include "../rodape.php"; // Inclui o rodapé
?>
