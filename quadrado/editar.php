<?php
    include "top.php";
    $acao = "Atualizar";
?>
<h2><?=$acao?> Quadrado</h2>

<?php
    include "form.php";
?>
<br><br>
<h2>Desenhar o Quadrado</h2>
<div>

    <div>
        <?php $quadrado->desenhar() ?>
    </div>

</div>
<br><br><br>