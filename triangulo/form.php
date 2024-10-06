<form action="triangulo.php" method="post" enctype="multipart/form-data">

    <div class="row">
        <input type="hidden" name="id" value="<?=empty($triangulo) ? "" : $triangulo->getId()?>">

        <div class="col-3">
            <select name="unidade_id" class="form-control" required>
                <option value="">Selecione a Unidade</option>
                <?php foreach ($unidades as $unidade) { 
                    $selected = (!empty($triangulo) && $triangulo->getUnidade()->getId() == $unidade->getId()) ? "selected" : ""; ?>
                    <option value="<?=$unidade->getId()?>" <?=$selected?>><?=$unidade->getDescricao()?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-3">
            <input type="number" name="ladoA" class="form-control" 
            value="<?=empty($triangulo) ? "" : $triangulo->getLadoA()?>"
            required placeholder="<?=$acao?> o Lado A" step="0.01">
        </div>

        <div class="col-3">
            <input type="number" name="ladoB" class="form-control" 
            value="<?=empty($triangulo) ? "" : $triangulo->getLadoB()?>"
            required placeholder="<?=$acao?> o Lado B" step="0.01">
        </div>

        <div class="col-3">
            <input type="number" name="ladoC" class="form-control" 
            value="<?=empty($triangulo) ? "" : $triangulo->getLadoC()?>"
            required placeholder="<?=$acao?> o Lado C" step="0.01">
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-4">
            <input type="color" name="cor" class="form-control" 
            value="<?=empty($triangulo) ? "" : $triangulo->getCor()?>"
            required placeholder="<?=$acao?> a Cor">
        </div>

        <div class="col-4">
            <input type="file" name="foto" id="foto" class="form-control" <?=empty($triangulo) ? 'required' : ''?>>
        </div>
    </div>

    <br><br>

    <div class="row">
        <input type="submit" value="<?=$acao;?>" name="acao" required class="btn btn-success">
    </div>

</form>
