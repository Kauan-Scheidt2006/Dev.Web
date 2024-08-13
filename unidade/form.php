
<form action="unidade.php" method="post">

   <div class="row">
        <input type="hidden" name="id" value="<?=empty($unidade) ? "": $unidade->getId()?>">
        <div class="col-4"></div>
        <div class="col-4">
            <input type="text" name="descricao" class="form-control" 
            value="<?=empty($unidade) ? "": $unidade->getDescricao()?>"
            required placeholder="<?=$acao?> a Unidade de Medida">
        </div>
        <div class="col-4"></div>
    </div>
    <br><b></b>
    <div class="row">
        <input type="submit" value="<?=$acao?>" name="acao" required class="btn btn-success">
    </div>

</form>

