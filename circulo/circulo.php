<?php
require_once("../classes/Circulo.class.php");
require_once("../classes/UnidadeMedida.class.php");

session_start();

$cabecalhoQuadrado = "../quadrado/";
$cabecalhoTriangulo = "../triangulo/";
$cabecalhoCirculo = "../circulo/";
$cabecalhoUnidadeMedida = "../unidademedida/";

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
    $raio = $_POST['raio'] ?? 1; // Aqui mudamos de tamanho para raio
    $cor = $_POST['cor'] ?? "#FF0000";
    $acao = $_POST['acao'] ?? "";

    // Validar unidade de medida
    $unidade = UnidadeMedida::listar([":id" => $unidadeId])[0] ?? new UnidadeMedida();

    // Processar imagem (caso exista)
    $foto = $_FILES['foto'] ?? null;
    $caminhoFoto = !empty($foto) ? salvarImagem($foto) : null;
    
    // Criar o objeto Circulo
    $circulo = new Circulo($id, $raio, $cor, $unidade, $caminhoFoto);

    switch ($acao) {
        case "Registrar":
            if ($caminhoFoto) {
                $resultado = $circulo->incluir();
                $_SESSION['mensagem'] = $resultado ? "Círculo registrado com sucesso." : "Falha ao registrar círculo.";
            } else {
                $_SESSION['mensagem'] = "Erro no upload da imagem.";
            }
            break;

        case "Atualizar":
            $resultado = $circulo->alterar();
            $_SESSION['mensagem'] = $resultado ? "Círculo atualizado com sucesso." : "Falha ao atualizar círculo.";
            break;

        case "Excluir":
            $resultado = Circulo::excluir($id);
            $_SESSION['mensagem'] = $resultado ? "Círculo excluído com sucesso." : "Falha ao excluir círculo.";
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
        // Editar um círculo existente
        $circulo = Circulo::listar([":id" => $editarId])[0] ?? null;
    } 
    else {
        // Filtros opcionais para listagem
        $filtros = empty($acao) ? array(): 
        [
            ":id" => empty($_GET['id']) ? "": $_GET['id'],
            ":unidade_id" => empty($_GET['unidade_id']) ? "": $_GET['unidade_id'],
            ":raio" => empty($_GET['raio']) ? "": $_GET['raio'],
            ":cor" => empty($_GET['cor']) ? "": $_GET['cor'],
        ];
        
        // Listar círculos com ou sem filtros
        $circulos = Circulo::listar($filtros);
    }
}
?>
