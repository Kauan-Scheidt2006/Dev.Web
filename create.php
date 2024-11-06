<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        // Inclui o arquivo de menu (navbar) para navegação
        include "menu.php";
    ?>
    <br><br>
    <!-- Formulário para criar ou alterar uma pessoa -->
    <form action="rota.php" method="post">
        <!-- Campo oculto para armazenar o ID da pessoa, se existir -->
        <input type="hidden" name="id"
        value="<?= empty($_SESSION['pessoa']['id']) ? "" : $_SESSION['pessoa']['id'] ?>">
        
        <div class="row">
            <div class="col-6">
                <!-- Campo para inserir o nome da pessoa -->
                <label for="nome">Insira um Nome</label>
                <input type="text" name="nome" id="nome" class="form-control"
                value="<?= empty($_SESSION['pessoa']['nome']) ? "" : $_SESSION['pessoa']['nome'] ?>" required>
            </div>
            <div class="col-6">
                <!-- Campo para inserir o telefone da pessoa -->
                <label for="telefone">Insira seu Telefone</label>
                <input type="tel" name="telefone" id="telefone" class="form-control"
                value="<?= empty($_SESSION['pessoa']['telefone']) ? "" : $_SESSION['pessoa']['telefone'] ?>" required>
            </div>
        </div>
        <br><br>
        <!-- Botão de envio do formulário com texto dinâmico -->
        <input type="submit" name="submit" class="btn btn-success"
        value="<?= empty($_SESSION['pessoa']['id']) ? "Registrar" : "Alterar" ?>">
    </form>
</body>
</html>
