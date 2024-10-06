<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Gerenciador de Formas Geométricas</title>
</head>
<body>
    <style>
        html, body{
            height: 100%;
        }
    </style>
    <?php
    $cabecalhoQuadrado = $cabecalhoQuadrado ?? null;
    $cabecalhoTriangulo = $cabecalhoTriangulo ?? null;
    $cabecalhoUnidadeMedida = $cabecalhoUnidadeMedida ?? null;
    $cabecalhoCirculo = $cabecalhoCirculo ?? null;

?>
    <div class="container">        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Sistema CRUD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <!-- Quadrado -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownQuadrado" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Quadrados
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownQuadrado">
                                <li><a class="dropdown-item" href="<?=$cabecalhoQuadrado?>index.php">Listar Quadrados</a></li>
                                <li><a class="dropdown-item" href="<?=$cabecalhoQuadrado?>registro.php">Registrar Quadrado</a></li>
                            </ul>
                        </li>
                        <!-- Triângulo -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTriangulo" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Triângulos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownTriangulo">
                                <li><a class="dropdown-item" href="<?=$cabecalhoTriangulo?>index.php">Listar Triângulos</a></li>
                                <li><a class="dropdown-item" href="<?=$cabecalhoTriangulo?>registro.php">Registrar Triângulo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTriangulo" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Circulos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownCirculo">
                                <li><a class="dropdown-item" href="<?=$cabecalhoCirculo?>index.php">Listar Circulos</a></li>
                                <li><a class="dropdown-item" href="<?=$cabecalhoCirculo?>registro.php">Registrar Circulo</a></li>
                            </ul>
                        </li>
                        <!-- Unidade -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUnidade" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Unidades
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownUnidade">
                                <li><a class="dropdown-item" href="<?=$cabecalhoUnidadeMedida?>index.php">Listar Unidades</a></li>
                                <li><a class="dropdown-item" href="<?=$cabecalhoUnidadeMedida?>registro.php">Registrar Unidade</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <?php if (!empty($_SESSION['mensagem'])): ?>
            <div class="alert alert-info mt-3">
                <?= $_SESSION['mensagem']; ?>
            </div>
        <?php endif; ?>
