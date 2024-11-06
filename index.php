<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Pessoas</title>
    <!-- Link para o arquivo CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="function.js"></script> <!-- Inclusão de script JavaScript -->
</head>
<body class="container mt-5">
    <?php
        include "rota.php"; // Inclusão do arquivo responsável pelas operações CRUD

        // Criação de uma instância da classe Pessoa para consulta
        $resul = new Pessoa();
        $filtros = []; // Array para armazenar filtros de pesquisa

        // Verifica se o formulário de filtro foi submetido e se há filtros preenchidos
        if (!empty($_POST['filtro']) && (!empty($_POST['id']) || !empty($_POST['nome']) || !empty($_POST['telefone']))) {
            // Adiciona filtro por ID
            if (!empty($_POST['id'])) {
                $filtros[] = ["id", " = ", $_POST['id']];
            }
            // Adiciona filtro por Nome
            if (!empty($_POST['nome'])) {
                $filtros[] = ["nome", " LIKE ", "%{$_POST['nome']}%"];
            }
            // Adiciona filtro por Telefone
            if (!empty($_POST['telefone'])) {
                $filtros[] = ["telefone", " LIKE ", "%{$_POST['telefone']}%"];
            }
        }

        // Chama o método listar para obter a lista de pessoas com base nos filtros
        $pessoas = $resul->listar($filtros);

        include "menu.php"; // Inclusão do menu de navegação
    ?>

    <!-- Exibição de mensagens de status -->
    <div class="alert alert-info text-center">
        <?= empty($_SESSION['mensagem']) ? "" : $_SESSION['mensagem'] ?>
    </div>

    <!-- Formulário para aplicar filtros de pesquisa -->
    <form action="" method="post">
        <fieldset class="border p-3">
            <legend class="w-auto">Pesquisa/Consulta</legend>

            <!-- Campos de filtro: ID, Nome e Telefone -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="id" class="form-label">ID</label>
                    <input type="number" name="id" id="id" class="form-control" 
                           value="<?= empty($_POST['id']) ? "" : $_POST['id'] ?>">
                </div>
                <div class="col-md-4">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" 
                           value="<?= empty($_POST['nome']) ? "" : $_POST['nome'] ?>">
                </div>
                <div class="col-md-4">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" 
                           value="<?= empty($_POST['telefone']) ? "" : $_POST['telefone'] ?>">
                </div>
            </div>

            <!-- Botão para aplicar os filtros -->
            <button type="submit" name="filtro" class="btn btn-primary">Aplicar Filtro</button>
        </fieldset>
    </form>

    <!-- Tabela para exibição dos resultados da pesquisa -->
    <table class="table table-striped table-hover mt-5 text-center">
        <thead>
            <tr>
                <th>Contagem</th>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $contagem = 1; // Variável de contagem para listar os resultados
            foreach ($pessoas as $pessoa) { ?>
                <tr>
                    <td><?= $contagem ?></td>
                    <td><?= $pessoa->getId() ?></td>
                    <td><?= $pessoa->getNome() ?></td>
                    <td><?= $pessoa->getTelefone() ?></td>
                    <td>
                        <!-- Formulário para editar pessoa -->
                        <form action="rota.php" method="post">
                            <input type="hidden" name="id" value="<?= $pessoa->getId() ?>">
                            <button type="submit" name="submit" value="Editar" class="btn btn-warning">Editar</button>
                        </form>
                    </td>
                    <td>
                        <!-- Formulário para excluir pessoa -->
                        <form action="rota.php" method="post" onsubmit="return del('<?= mb_strtoupper($pessoa->getNome()) ?>')">
                            <input type="hidden" name="id" value="<?= $pessoa->getId() ?>">
                            <button type="submit" name="submit" value="Excluir" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
                <?php $contagem++; } ?>
        </tbody>
    </table>

    <!-- Inclusão de script para o Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
