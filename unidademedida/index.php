<?php
include "unidademedida.php";
include "../cabecalho.php";

?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Unidades de Medida</h2>
    <a href="registro.php" class="btn btn-success">Nova Unidade de Medida</a>

    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th colspan="2">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($unidades as $unidade) : ?>
                <tr>
                    <td><?= $unidade->getId() ?></td>
                    <td><?= $unidade->getDescricao() ?></td>
                    <td>
                        <a href="editar.php?editar=<?= $unidade->getId() ?>" class="btn btn-warning">Editar</a>
                    </td>
                    <td>
                        <form action="unidadeMedida.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $unidade->getId() ?>">
                            <input type="hidden" name="acao" value="Excluir">
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>

<?php
include "../rodape.php";
?>
