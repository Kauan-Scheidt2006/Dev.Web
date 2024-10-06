<?php
require_once("../classes/Triangulo.class.php");
require_once("../classes/TrianguloEscaleno.class.php");
require_once("../classes/TrianguloIsoceles.class.php");
require_once("../classes/TrianguloEquilatero.class.php");
require_once("../classes/UnidadeMedida.class.php");
session_start();

$cabecalhoQuadrado = "../quadrado/";
$cabecalhoUnidadeMedida = "../unidademedida/";
$cabecalhoCirculo = "../circulo/";

// Função auxiliar para mover arquivo
function salvarImagem($arquivo) {
    $nomeArquivo = date("Ymdhis") . "." . pathinfo($arquivo['name'], PATHINFO_EXTENSION);
    $caminhoCompleto = "../" . IMG . "/$nomeArquivo";
    
    if (move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
        return $caminhoCompleto;
    }
    
    return false;
}

// Tratamento de POST (Inserir, Atualizar, Excluir)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'] ?? 0;
    $unidadeId = $_POST['unidade_id'] ?? null;
    $ladoA = $_POST['ladoA'] ?? 1;
    $ladoB = $_POST['ladoB'] ?? 1;
    $ladoC = $_POST['ladoC'] ?? 1;
    $cor = $_POST['cor'] ?? "#FF0000";
    $acao = $_POST['acao'] ?? "";

    // Validar unidade de medida
    echo "chegou";
    $unidade = UnidadeMedida::listar([":id" => $unidadeId])[0] ?? new UnidadeMedida();
    // Processar imagem (caso exista)
    $foto = $_FILES['foto'] ?? null;
    $caminhoFoto = !empty($foto) ? salvarImagem($foto) : null;

    // Função para determinar o tipo do triângulo com base nos lados
    function determinarTipoTriangulo($ladoA, $ladoB, $ladoC) {
        if ($ladoA == $ladoB && $ladoB == $ladoC) {
            return 'Equilátero';
        } elseif ($ladoA == $ladoB || $ladoA == $ladoC || $ladoB == $ladoC) {
            return 'Isósceles';
        } else {
            return 'Escaleno';
        }
    }

    // Determinar o tipo do triângulo
    $trianguloTipo = determinarTipoTriangulo($ladoA, $ladoB, $ladoC);

    // Criar o objeto Triângulo baseado no tipo
    switch ($trianguloTipo) {
        case 'Equilátero':
            $triangulo = new TrianguloEquilatero($id, $ladoA, $ladoB, $ladoC, $cor, $unidade, $caminhoFoto, "Equilátero");
            break;
        case 'Isósceles':
            $triangulo = new TrianguloIsoceles($id, $ladoA, $ladoB, $ladoC, $cor, $unidade, $caminhoFoto, "Isósceles");
            break;
        case 'Escaleno':
            $triangulo = new TrianguloEscaleno($id, $ladoA, $ladoB, $ladoC, $cor, $unidade, $caminhoFoto, "Escaleno");
            break;
    }

    switch ($acao) {
        case "Registrar":
            if ($caminhoFoto) {
                $resultado = $triangulo->incluir();
                $_SESSION['mensagem'] = $resultado ? "Triângulo registrado com sucesso." : "Falha ao registrar triângulo.";
            } else {
                $_SESSION['mensagem'] = "Erro no upload da imagem.";
            }
            break;

        case "Atualizar":
            $resultado = $triangulo->alterar();
            $_SESSION['mensagem'] = $resultado ? "Triângulo atualizado com sucesso." : "Falha ao atualizar triângulo.";
            break;

        case "Excluir":
            $resultado = Triangulo::excluir($id);
            $_SESSION['mensagem'] = $resultado ? "Triângulo excluído com sucesso." : "Falha ao excluir triângulo.";
            break;
    }

    // Redirecionar para a página de listagem
    header("Location: index.php");
    exit;
}

// Tratamento de GET (Listar e Editar)
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $editarId = $_GET['editar'] ?? null;
    
    // Listar unidades para o formulário
    $unidades = UnidadeMedida::listar();
    
    if ($editarId > 0) {
        // Editar um triângulo existente
        $triangulo = Triangulo::listar([":id" => $editarId])[0] ?? null;
    } else {
        // Filtros opcionais para listagem
        $filtros = empty($acao) ? array(): [
            ":id" => empty($_GET['id']) ? null : $_GET['id'],
            ":id_unidade" => empty($_GET['unidade_id']) ? null : $_GET['unidade_id'],
            ":ladoA" => empty($_GET['ladoA']) ? null : $_GET['ladoA'],
            ":ladoB" => empty($_GET['ladoB']) ? null : $_GET['ladoB'],
            ":ladoC" => empty($_GET['ladoC']) ? null : $_GET['ladoC'],
            ":cor" => empty($_GET['cor']) ? null : $_GET['cor'],
            ":fundo" => empty($_GET['fundo']) ? null : $_GET['fundo'],
            ":trianguloTipo" => empty($_GET['trianguloTipo']) ? null : $_GET['trianguloTipo'],
            
        ];
        
        // Listar triângulos com ou sem filtros
        $triangulos = Triangulo::listar($filtros);
    }
}
