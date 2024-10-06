<?php

    // Inclui a lógica de controle do Triângulo
    include_once "triangulo.php";

    include "../cabecalho.php"; // Inclui o cabeçalho com a navegação e as dependências

    // Inicia o controle de ações
    $action = $_GET['acao'] ?? '';
?>

<h2>Listagem de Triângulos</h2>
<h3>Filtros</h3>
<form action="" method="get">
    <div class="row">
        <div class="col-2">
            <input type="number" name="id" class="form-control" placeholder="Insira o id"
            value="<?= !empty($_GET['id']) ? $_GET['id'] : "" ?>">
        </div>
        <div class="col-3">
            <select name="unidade_id" class="form-control">
                <option value="">Selecione a Unidade</option>
                <?php foreach ($unidades as $unidade): ?>
                    <option value="<?= $unidade->getId() ?>" <?= !empty($_GET['unidade_id']) && $_GET['unidade_id'] == $unidade->getId() ? 'selected' : '' ?>>
                        <?= $unidade->getDescricao() ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-2">
            <input type="number" name="ladoA" class="form-control"  
            value="<?= !empty($_GET['ladoA']) ? $_GET['ladoA'] : "" ?>"
            step="0.01" placeholder="Lado A">
        </div>
        <div class="col-2">
            <input type="number" name="ladoB" class="form-control"  
            value="<?= !empty($_GET['ladoB']) ? $_GET['ladoB'] : "" ?>"
            step="0.01" placeholder="Lado B">
        </div>
        <div class="col-2">
            <input type="number" name="ladoC" class="form-control"  
            value="<?= !empty($_GET['ladoC']) ? $_GET['ladoC'] : "" ?>"
            step="0.01" placeholder="Lado C">
        </div>
        <div class="col-2">
            <input type="color" name="cor" class="form-control" placeholder="Insira a cor"
            value="<?= !empty($_GET['cor']) ? $_GET['cor'] : "" ?>">
        </div>
    </div>
    <input type="submit" value="Consultar" class="btn btn-primary" name="acao">
    <a href="index.php" class="btn btn-secondary">Limpar Consulta</a>
</form>
<br><br>
<table class="table table-striped" style="text-align: center;">
    <thead>
        <tr>
            <th>Contagem</th> <th>Id</th> <th>Triângulo</th> <th>Lado A</th> <th>Lado B</th> <th>Lado C</th> <th>Unidade</th> <th>Cor</th>
            <th>Área</th> <th>Perímetro</th>  <th colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($triangulos as $key => $triangulo): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $triangulo->getId() ?></td>  
                <td> <?=$triangulo->getTrianguloTipo()?> </td>
                <td><?= $triangulo->getLadoA() ?></td> 
                <td><?= $triangulo->getLadoB() ?></td> 
                <td><?= $triangulo->getLadoC() ?></td> 
                <td><?= $triangulo->getUnidade()->getDescricao() ?></td>
                <td><?= $triangulo->getCor() ?></td>
                <td> <?=$triangulo->calcularArea()?> </td>
                <td> <?=$triangulo->calcularPerimetro()?> </td>
                <td>
                    <a href="editar.php?editar=<?= $triangulo->getId() ?>" class="btn btn-warning">
                        Editar
                    </a>
                </td>
                <td>
                    <form action="triangulo.php" method="post">
                        <input type="hidden" name="unidade_id" value="<?= $triangulo->getUnidade()->getId() ?>" required>
                        <input type="hidden" name="id" value="<?= $triangulo->getId() ?>" required>
                        <input type="submit" name="acao" value="Excluir" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
    include "../rodape.php"; // Inclui o rodapé com a estrutura final
?>
