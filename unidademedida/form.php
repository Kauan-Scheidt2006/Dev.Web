<form action="unidademedida.php" method="post">

    <div class="row">
        <input type="hidden" name="id" value="<?= empty($unidade) ? "" : $unidade->getId() ?>">

        <div class="text-center">
            <input type="text" name="descricao" class="form-control" 
            value="<?= empty($unidade) ? "" : $unidade->getDescricao() ?>"
            required placeholder="<?=$acao?> a Descrição">
        </div>
    </div>

    <br>

    <div class="row">
        <input type="submit" value="<?= $acao ?>" name="acao" required class="btn btn-success">
    </div>

</form>
