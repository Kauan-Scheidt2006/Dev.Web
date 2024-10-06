<?php
require_once("../classes/UnidadeMedida.class.php");
session_start();
$cabecalhoQuadrado = "../quadrado/";
$cabecalhoTriangulo = "../triangulo/";
$cabecalhoCirculo = "../circulo/";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'] ?? 0;
    $descricao = $_POST['descricao'] ?? "";
    $acao = $_POST['acao'] ?? "";

    $unidade = new UnidadeMedida($id, $descricao);

    switch ($acao) {
        case "Registrar":
            $resultado = $unidade->incluir();
            $_SESSION['mensagem'] = $resultado ? "Unidade de medida registrada com sucesso." : "Falha ao registrar a unidade de medida.";
            break;

        case "Atualizar":
            $resultado = $unidade->alterar();
            $_SESSION['mensagem'] = $resultado ? "Unidade de medida atualizada com sucesso." : "Falha ao atualizar a unidade de medida.";
            break;

        case "Excluir":
            $resultado = UnidadeMedida::excluir($id);
            $_SESSION['mensagem'] = $resultado ? "Unidade de medida excluída com sucesso." : "Falha ao excluir a unidade de medida.";
            break;
    }

    // Redirecionar de volta para a página de listagem
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $editarId = $_GET['editar'] ?? null;

    // Listar unidades para o formulário
    if ($editarId > 0) {
        $unidade = UnidadeMedida::listar([":id" => $editarId])[0] ?? null;
    } else {
        $unidades = UnidadeMedida::listar();
    }
}
?>
