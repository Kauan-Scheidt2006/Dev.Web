<form action="circulo.php" method="post" enctype="multipart/form-data">

    <div class="row">
        <input type="hidden" name="id" value="<?=empty($circulo) ? "" : $circulo->getId()?>">

        <div class="col-6">
            <select name="unidade_id" class="form-control" required>
                <option value="">Selecione a Unidade</option>
                <?php foreach ($unidades as $unidade) { 
                    $selected = (!empty($circulo) && $circulo->getUnidade()->getId() == $unidade->getId()) ? "selected" : ""; ?>
                    <option value="<?=$unidade->getId()?>" <?=$selected?>><?=$unidade->getDescricao()?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-6">
            <input type="number" name="raio" class="form-control" 
            value="<?=empty($circulo) ? "" : $circulo->getRaio()?>"
            required placeholder="<?=$acao?> o Raio" step="0.01">
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-6">
            <input type="color" name="cor" class="form-control" 
            value="<?=empty($circulo) ? "" : $circulo->getCor()?>"
            required placeholder="<?=$acao?> a Cor">
        </div>

        <div class="col-6">
            <input type="file" name="foto" id="foto" class="form-control" <?=empty($circulo) ? 'required' : ''?> accept="image/*">
        </div>
    </div>

    <br><br>

    <div class="row">
        <input type="submit" value="<?=$acao;?>" name="acao" required class="btn btn-success">
    </div>

</form>
