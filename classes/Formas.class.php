<?php

abstract class Formas {
    private $id; 
    private $cor;
    private $unidade; // objeto UnidadeMedida
    private $fundo;

    public function __construct($id = 0, $cor = null, UnidadeMedida $unidade = null, $fundo = null) {
        $this->setId($id);
        $this->setCor($cor);
        $this->setUn($unidade);
        $this->setFundo($fundo);
    }

    // Setter para ID com validação de número positivo
    public function setId($novoId) {
        $this->id = $novoId;
    }

    // Setter para a cor
    public function setCor($cor) {
        if (empty($cor)) {
            throw new Exception("Erro: A cor não pode ser vazia!");
        }
        $this->cor = $cor;
    }

    // Setter para o fundo (imagem de fundo)
    public function setFundo($fundo) {
        $this->fundo = $fundo;
    }

    // Setter para UnidadeMedida com validação
    public function setUn(UnidadeMedida $unidade = null) {
        if ($unidade) {
            $this->unidade = $unidade;
        } else {
            throw new Exception("Erro: Deve ser informada uma unidade de medida válida!");
        }
    }

    // Getters
    public function getId() { 
        return $this->id; 
    }

    public function getCor() { 
        return $this->cor;
    }

    public function getUnidade() { 
        return $this->unidade;
    }

    public function getFundo() { 
        return $this->fundo;
    }

    // Métodos abstratos para serem implementados nas classes filhas
    abstract public function incluir();
    abstract public static function excluir($id);
    abstract public function alterar();
    abstract public static function listar($atributos = array());
    abstract public function desenhar();
    abstract public function calcularArea();
    abstract public function calcularPerimetro();
}
