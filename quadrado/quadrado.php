<?php
require_once("../classes/Quadrado.class.php");
require_once("../classes/Unidade.class.php");
session_start();

switch($_SERVER["REQUEST_METHOD"]){
    case "POST":
        $id = !empty($_POST['id']) ? $_POST['id']: 0;
        
        $unidade = !empty($_POST['unidade_id']) ? 
                Unidade::listar([":id"=>$_POST['unidade_id']])[0] : new Unidade();
        
        $tamanho = !empty($_POST['tamanho']) ? $_POST['tamanho'] : 1;
        $cor = !empty($_POST['cor']) ? $_POST['cor']: "#FF0000";

        $quadrado = new Quadrado($id, $unidade, $tamanho, $cor);

        switch($_POST['acao']){
            case "Registrar":

                $_SESSION['mensagem'] = $quadrado->inserir() == true ? "Quadrado registrado com sucesso" 
                : "Falha ao Registrar Quadrado"; 
                header("Location: index.php");
                break;

            case "Atualizar":
                unset($_SESSION['quadrado']);
                $_SESSION['mensagem'] = $quadrado->atualizar() == true ? "Quadrado atualizado com sucesso" 
                    : "Falha ao atualizar quadrado";
                    header("Location: index.php");
                    break;

            case "Excluir":
                $_SESSION['mensagem'] = Quadrado::excluir($_POST['id']) == true ? "Quadrado excluído com sucesso"
                : "Falha ao excluir quadrado";
                header("Location: index.php");
                break;
        }


    default:
    $unidades = Unidade::listar();

        if(empty($_GET['editar'])){
            
            if(empty($_GET['acao']))
                $quadrados = Quadrado::listar();

            else{
                    $atributos = [
                        ":id" =>  !empty($_GET['id']) ? $_GET['id']: null,
                        ":unidade_id" =>  !empty($_GET['unidade_id']) ? $_GET['unidade_id']: null,
                        ":tamanho" => !empty($_GET['tamanho']) ? $_GET['tamanho']: null,
                        ":cor" => !empty($_GET['cor']) ? $_GET['cor']: null
                    ];
                    $quadrados = Quadrado::listar($atributos);
                

        }
        }
        else{
            $quadrado = Quadrado::editar($_GET['editar']);

        }
            
}