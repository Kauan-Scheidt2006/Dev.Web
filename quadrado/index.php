<?php
    include "top.php";?>

    <h2>Listagem de Quadrados</h2>
    <h3>Filtros</h3>
    <form action="" method="get">
        <div class="row">
            <div class="col-3">
                <input type="number" name="id" class="form-control" placeholder="Insira o id"
                value="<?= empty($_GET['id']) ? "": $_GET['id'] ?>">
            </div>
            <div class="col-3">
                <select name="unidade_id" class="form-control">
                    <?php
                        foreach($unidades as $unidade){
                            $selected = ""; 
                            if(!empty($_GET["unidade_id"]) && $unidade->getId() == $_GET['unidade_id'])
                                $selected = "selected"
                            ?>
                            <option value="<?=$unidade->getId()?>" <?=$selected?>
                            
                            > <?= $unidade->getDescricao() ?> </option>    
                        <?php
                        }
                    ?>
                    <option value=""></option>
                </select>
            </div>
            <div class="col-3">
                <input type="text" name="tamanho" class="form-control"  
                value="<?= empty($_GET["tamanho"]) ? "": $_GET['tamanho']?>"
                step="0.01" placeholder="Insira o tamanho">
            </div>
            <div class="col-2">
                <input type="color" name="cor" class="form-control" placeholder="Insira a cor"
                value="<?= empty($_GET["cor"]) ? "": $_GET['cor']?>"
                >
            </div>
        </div>
        <input type="submit" value="Consultar" class="btn btn-primary" name="acao">
        <a href="index.php" class="btn btn-secondary">Limpar Consulta</a>
    </form>
    <br><br>
    <table class="table table-striped" style="text-align: center;">
        <tr>
            <th>Contagem</th> <th>Id</th> <th>Tamanho</th>  <th>Unidade</th> <th>Cor</th>
            
              <th>Editar</th> <th>Excluir</th>
        </tr>

        <?php
        
            foreach($quadrados as $key => $quadrado){ ?>
                <tr>
                    <td><?=$key?></td>
                    <td> <?= $quadrado->getId() ?> </td>  
                    <td><?=$quadrado->getTamanho()?></td> 
                    <td><?= $quadrado->getUnidade()->getDescricao() ?></td>
                    <td><?=$quadrado->getCor()?></td>
                    <td>
                        <a href="editar.php?editar=<?=$quadrado->getId()?>" class="btn btn-warning">
                            Editar
                        </a>
                    </td>

                    <td>
                        <form action="quadrado.php" method="post">
                            <input type="hidden" name="id" value="<?=$quadrado->getId()?>" required>
                            <input type="submit" name="acao" value="Excluir" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
<?php
    } ?>
    </table>

<?php
    include "bottom.php";?>