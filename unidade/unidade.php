<?php
require_once("../classes/Unidade.class.php");
session_start();

switch($_SERVER["REQUEST_METHOD"]){
    case "POST":
        $id = !empty($_POST['id']) ? $_POST['id']: 0;
        $descricao = !empty($_POST['descricao']) ? $_POST['descricao']: "Descrição";
        //Instancia um novo objeto
        $unidade = new Unidade($id, $descricao);
        switch($_POST['acao']){
            case "Registrar":
                $_SESSION['mensagem'] = $unidade->inserir() == true ? "Unidade registrado com sucesso" 
                : "Falha ao Registrar Unidade";
                header("Location: index.php");
                break;

            case "Atualizar":
                unset($_SESSION['unidade']);
                $_SESSION['mensagem'] = $unidade->atualizar() == true ? "Unidade atualizado com sucesso" 
                    : "Falha ao atualizar unidade";
                    header("Location: index.php");
                    break;

            case "Excluir":
                echo $_POST['id'];
                $_SESSION['mensagem'] = Unidade::excluir($_POST['id']) == true ? "Unidade excluído com sucesso"
                : "Falha ao excluir unidade";
                header("Location: index.php");
                break;
        }


    default:
        if(empty($_GET['editar'])){
            if(empty($_GET['acao'])){
                $unidades = Unidade::listar();
            }

            else{
                $atributos = [
                    ":id" =>  !empty($_GET['id']) ? $_GET['id']: null,
                    ":descricao" =>  !empty($_GET['descricao']) ? $_GET['descricao']: null,
                    ];
                $unidades = Unidade::listar($atributos);


        }
    }
        else
            $unidade = Unidade::editar($_GET['editar']); 
        
            
}