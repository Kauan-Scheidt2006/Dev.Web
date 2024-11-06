<?php
require_once('Pessoa.class.php');

/**
 * Script para gerenciar as requisições CRUD (Create, Read, Update, Delete) para a entidade Pessoa.
 * O comportamento do script é determinado pelo método de requisição POST.
 */

// Verifica se o método da requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ação recebida do formulário (Registrar, Alterar, Excluir)
    $acao = $_POST['submit'];

    // Verifica se o ID foi enviado, caso contrário define como 0
    $id = isset($_POST['id']) ? $_POST['id'] : 0;

    // Recebe os valores do formulário
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];

    // Instancia um novo objeto Pessoa com os dados do formulário
    $pessoa = new Pessoa($id, $nome, $telefone);

    // Verifica qual ação foi solicitada e executa o método correspondente
    switch ($acao) {
        case 'Registrar':
            // Adiciona uma nova pessoa ao banco de dados
            $pessoa->incluir();
            exit; // Encerra a execução após registrar
            break;

        case 'Alterar':
            // Altera os dados de uma pessoa existente
            $pessoa->alterar();
            break;

        case 'excluir':
            // Exclui uma pessoa com base no ID fornecido
            Pessoa::excluir($id);
            break;
    }

    // Redireciona para a página principal (index.php) após a ação
    header('Location: index.php');
}
?>
