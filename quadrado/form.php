<form action="quadrado.php" method="post" enctype="multipart/form-data">

    <div class="row mb-3">
        <input type="hidden" name="id" value="<?= empty($quadrado) ? "" : $quadrado->getId() ?>">

        <!-- Seleção da Unidade -->
        <div class="col-md-4">
            <label for="unidade_id" class="form-label">Unidade</label>
            <select name="unidade_id" class="form-select" required>
                <option value="">Selecione a Unidade</option>
                <?php foreach ($unidades as $unidade) { 
                    $selected = (!empty($quadrado) && $quadrado->getUnidade()->getId() == $unidade->getId()) ? "selected" : ""; ?>
                    <option value="<?= $unidade->getId() ?>" <?= $selected ?>><?= $unidade->getDescricao() ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Espaço entre colunas -->
        <div class="col-md-1"></div>

        <!-- Input de Tamanho -->
        <div class="col-md-4">
            <label for="tamanho" class="form-label">Tamanho</label>
            <input type="number" name="tamanho" class="form-control" 
                value="<?= empty($quadrado) ? "" : $quadrado->getLado() ?>"
                required placeholder="Digite o Tamanho" step="0.01">
        </div>
    </div>

    <div class="row mb-4">
        <!-- Input de Cor -->
        <div class="col-md-4">
            <label for="cor" class="form-label">Cor</label>
            <input type="color" name="cor" class="form-control" 
                value="<?= empty($quadrado) ? "" : $quadrado->getCor() ?>"
                required>
        </div>

        <!-- Input de Upload de Foto -->
        <div class="col-md-4">
            <label for="foto" class="form-label">Imagem de Fundo</label>
            <input type="file" name="foto" id="foto" class="form-control" <?= empty($quadrado) ? 'required' : '' ?>>
        </div>
    </div>

    <!-- Botão de Submit -->
    <div class="row">
        <div class="col-md-4">
            <input type="submit" value="<?= $acao ?>" name="acao" class="btn btn-success w-100">
        </div>
    </div>

</form>
