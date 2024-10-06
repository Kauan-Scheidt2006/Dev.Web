<?php
require_once("circulo.php");
include "../cabecalho.php"; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Lista de Círculos</h2>

    <div class="row mb-3">
        <div class="col-md-12 text-right">
            <a href="registro.php" class="btn btn-primary">Registrar Novo Círculo</a>
        </div>
    </div>

    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Raio</th>
                <th>Cor</th>
                <th>Unidade de Medida</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($circulos as $circulo): ?>
                <tr>
                    <td><?= $circulo->getId(); ?></td>
                    <td><?= $circulo->getRaio(); ?></td>
                    <td style="background-color: <?= $circulo->getCor(); ?>; color:white"><?= $circulo->getCor(); ?></td>
                    <td><?= $circulo->getUnidade()->getDescricao(); ?></td>
                    <td>
                        <a href="editar.php?editar=<?= $circulo->getId(); ?>" class="btn btn-warning">Editar</a>
                        <a href="circulo.php?acao=Excluir&id=<?= $circulo->getId(); ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "../rodape.php"; ?>