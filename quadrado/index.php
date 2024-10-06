<?php

    // Inclui a lógica de controle do Quadrado
    include_once "quadrado.php";

    include "../cabecalho.php"; // Inclui o cabeçalho com a navegação e as dependências

    // Inicia o controle de ações
    $action = $_GET['acao'] ?? '';
?>

<h2>Listagem de Quadrados</h2>
<h3>Filtros</h3>
<form action="" method="get">
    <div class="row">
        <div class="col-3">
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
        <div class="col-3">
            <input type="text" name="lado" class="form-control"  
            value="<?= !empty($_GET['lado']) ? $_GET['lado'] : "" ?>"
            step="0.01" placeholder="Insira o lado">
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
            <th>Contagem</th> <th>Id</th> <th>Tamanho</th>  <th>Unidade</th> <th>Cor</th>
            <th>Área</th> <th>Perímetro</th> <th colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($quadrados as $key => $quadrado): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $quadrado->getId() ?></td>  
                <td><?= $quadrado->getLado() ?></td> 
                <td><?= $quadrado->getUnidade()->getDescricao() ?></td>
                <td><?= $quadrado->getCor() ?></td>
                <td> <?=$quadrado->calcularArea()?> </td>
                <td> <?=$quadrado->calcularPerimetro()?> </td>
                <td>
                    <a href="editar.php?editar=<?= $quadrado->getId() ?>" class="btn btn-warning">
                        Editar
                    </a>
                </td>
                <td>
                    <form action="quadrado.php" method="post">
                        <input type="hidden" name="id" value="<?= $quadrado->getId() ?>" required>
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
