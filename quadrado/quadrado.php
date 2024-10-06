<?php
require_once("../classes/Quadrado.class.php");
require_once("../classes/UnidadeMedida.class.php");
session_start();
$cabecalhoTriangulo = "../triangulo/";
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
    $tamanho = $_POST['tamanho'] ?? 1;
    $cor = $_POST['cor'] ?? "#FF0000";
    $acao = $_POST['acao'] ?? "";

    // Validar unidade de medida
    $unidade = UnidadeMedida::listar([":id" => $unidadeId])[0] ?? new UnidadeMedida();

    // Processar imagem (caso exista)
    $foto = $_FILES['foto'] ?? null;
    $caminhoFoto = !empty($foto) ? salvarImagem($foto) : null;
    
    // Criar o objeto Quadrado
    $quadrado = new Quadrado($id, $tamanho, $cor, $unidade, $caminhoFoto);

    switch ($acao) {
        case "Registrar":
            if ($caminhoFoto) {
                $resultado = $quadrado->incluir();
                $_SESSION['mensagem'] = $resultado ? "Quadrado registrado com sucesso." : "Falha ao registrar quadrado.";
            } else {
                $_SESSION['mensagem'] = "Erro no upload da imagem.";
            }
            break;

        case "Atualizar":
            $resultado = $quadrado->alterar();
            $_SESSION['mensagem'] = $resultado ? "Quadrado atualizado com sucesso." : "Falha ao atualizar quadrado.";
            break;

        case "Excluir":
            $resultado = $quadrado->excluir($id);
            $_SESSION['mensagem'] = $resultado ? "Quadrado excluído com sucesso." : "Falha ao excluir quadrado.";
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
        // Editar um quadrado existente
        $quadrado = Quadrado::listar([":id" => $editarId])[0] ?? null;
    } 
    else {
        // Filtros opcionais para listagem
        $filtros = empty($acao) ? array(): 
        [
            ":id" => empty($_GET['id']) ? "": $_GET['id'],
            ":unidade_id" => empty($_GET['unidade_id']) ? "": $_GET['unidade_id'],
            ":lado" => empty($_GET['lado']) ? "": $_GET['lado'],
            ":cor" => empty($_GET['cor']) ? "": $_GET['cor'],
        ];
        
        // Listar quadrados com ou sem filtros
        $quadrados = Quadrado::listar($filtros);
       
    }
}
