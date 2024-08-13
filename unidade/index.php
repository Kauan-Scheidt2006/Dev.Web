<?php
    include "top.php";?>

    <h2>Listagem de Unidades</h2>
    <h3>Filtros</h3>
    <form action="" method="get">
        <div class="row">
            <div class="col-4">
                <input type="number" name="id" class="form-control" placeholder="Insira o id"
                value="<?= empty($_GET['id']) ? "": $_GET['id'] ?>">
            </div>
            <div class="col-4"></div>
            <div class="col-4">
                <input type="text" name="descricao" class="form-control" 
                placeholder="Insira a unidade"
                value="<?= empty($_GET['descricao']) ? "": $_GET['descricao'] ?>">
            </div>
            
        </div>
        <input type="submit" value="Consultar" class="btn btn-primary" name="acao">
    </form>
    <br><br>
    <table class="table table-striped" style="text-align: center;">
        <tr>
            <th>Contagem</th> <th>Id</th> <th>Unidade</th> <th>Editar</th> <th>Excluir</th>  
        </tr>

        <?php
            foreach($unidades as $key => $unidade){ ?>
                <tr>
                    <td><?=$key?></td> 
                    <td><?= $unidade->getId() ?></td> <td><?=$unidade->getDescricao()?></td>
                    <td>
                        <a href="editar.php?editar=<?=$unidade->getId()?>" class="btn btn-warning">
                            Editar
                        </a>
                    </td>

                    <td>
                        <form action="unidade.php" method="post">
                            <input type="hidden" name="id" value="<?=$unidade->getId()?>" required>
                            <input type="submit" name="acao" value="Excluir" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
<?php
    } ?>
    </table>

<?php
    include "bottom.php";?>