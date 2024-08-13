
<form action="quadrado.php" method="post">

   <div class="row">
        <input type="hidden" name="id" value="<?=empty($quadrado) ? "": $quadrado->getId()?>">
        <div class="col-3">
            <select name="unidade_id" class="form-control">
                <?php
                
                foreach($unidades as $unidade){ 
                    if(!empty($quadrado) && $quadrado->getUnidade()->getId() == $unidade->getId())
                        $select = "selected";
                    else
                        $select = "";
                    ?>
                    <option value="<?=$unidade->getId()?>" <?=$select?> > <?=$unidade->getDescricao()?></option>
            <?php }?>
            </select>
        </div>
        <div class="col-1"></div>
        <div class="col-3">
            <input type="number" name="tamanho" class="form-control"
            value="<?=empty($quadrado) ? "": $quadrado->getTamanho()?>"
            required placeholder="<?=$acao?> o Tamanho" step="0.01">
        </div>
        <div class="col-1"></div>
        <div class="col-4">
            <input type="color" name="cor" class="form-control" 
            value="<?=empty($quadrado) ? "": $quadrado->getCor()?>"
            required placeholder="<?=$acao?> a Cor">
        </div>
    </div>
    <br><b></b>
    <div class="row">
        <input type="submit" value="<?=$acao;?>" name="acao" required class="btn btn-success">
    </div>

</form>

