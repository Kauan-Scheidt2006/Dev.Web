<?php
require_once("../classes/Database.class.php");
require_once("../classes/UnidadeMedida.class.php");
require_once("../classes/Formas.class.php");

class Circulo extends Formas {
    protected $raio;

    public function __construct($id = 0, $raio = 0, $cor = null, UnidadeMedida $un = null, $fundo = null) {
        parent::__construct($id, $cor, $un, $fundo);
        $this->setRaio($raio);
    }

    // Getter e Setter para o Raio
    public function getRaio() {
        return $this->raio;
    }

    public function setRaio($raio) {
        if ($raio <= 0) {
            throw new Exception("Erro: O raio deve ser maior que zero.");
        }
        $this->raio = $raio;
    }

    // Métodos de banco de dados
    public function incluir() {
        $sql = 'INSERT INTO circulo (raio, cor, id_unidade, fundo) VALUES (:raio, :cor, :id_unidade, :fundo)';
        $parametros = array(
            ':raio' => $this->getRaio(),
            ':cor' => $this->getCor(),
            ':id_unidade' => $this->getUnidade()->getId(),
            ':fundo' => $this->getFundo()
        );
        return Database::executar($sql, $parametros);
    }

    public function alterar() {
        if ($this->getId() <= 0) {
            throw new Exception("Erro: O ID do círculo é inválido.");
        }
    
        $sql = "UPDATE circulo 
                SET raio = :raio, cor = :cor, id_unidade = :id_unidade, fundo = :fundo 
                WHERE id = :id";
        
        $parametros = array(
            ':id' => $this->getId(),
            ':raio' => $this->getRaio(),
            ':cor' => $this->getCor(),
            ':id_unidade' => $this->getUnidade()->getId(),
            ':fundo' => $this->getFundo()
        );
    
        return Database::executar($sql, $parametros);
    }

    public static function listar($atributos = array()) {
        $sql = "SELECT * FROM circulo";
        if (!empty($atributos)) {
            $sql .= " WHERE ";
            $primeiroAtributo = true;

            foreach ($atributos as $key => $atributo) {
                $coluna = str_replace(":", "", $key);
                if ($primeiroAtributo) {
                    $sql .= " $coluna = $key";
                    $primeiroAtributo = false;
                } else {
                    $sql .= " OR $coluna = $key";
                }
            }
        }

        $comando = Database::executar($sql, $atributos);
        $circulos = array();
        while ($registro = $comando->fetch(PDO::FETCH_ASSOC)) {
            $un = UnidadeMedida::listar([":id" => $registro['id_unidade']])[0];
            $circulo = new Circulo(
                $registro['id'],
                $registro['raio'],
                $registro['cor'],
                $un,
                $registro['fundo']
            );
            array_push($circulos, $circulo);
        }
        return $circulos;
    }

    public static function excluir($id) {
        if ($id <= 0) {
            throw new Exception("Erro: O ID do círculo é inválido.");
        }
    
        $sql = "DELETE FROM circulo WHERE id = :id";
        $parametros = array(':id' => $id);
    
        return Database::executar($sql, $parametros);
    }

    // Métodos para cálculos geométricos
    public function calcularArea() {
        return pi() * pow($this->getRaio(), 2);
    }

    public function calcularPerimetro() {
        return 2 * pi() * $this->getRaio();
    }

    // Método para desenvolver o cálculo da área
    public function desenvolverCalculoArea() {
        $raio = $this->getRaio();
        $area = $this->calcularArea();
        return "Área = π * r² = π * {$raio}² = π * " . pow($raio, 2) . " = " . number_format($area, 2) . " " . $this->getUnidade()->getDescricao() . "²";
    }

    // Método para desenvolver o cálculo do perímetro
    public function desenvolverCalculoPerimetro() {
        $raio = $this->getRaio();
        $perimetro = $this->calcularPerimetro();
        return "Perímetro = 2 * π * r = 2 * π * {$raio} = " . number_format($perimetro, 2) . " " . $this->getUnidade()->getDescricao();
    }

    // Método para "desenhar" o círculo (HTML)
    public function desenhar() {
        return "<div class='forma' 
                style='
                height: " . ($this->getRaio() * 2) . $this->getUnidade()->getDescricao(). "; 
                width: " . ($this->getRaio() * 2) . $this->getUnidade()->getDescricao(). "; 
                border-radius: 50%; 
                background-image: url(". $this->getFundo() .");
                background-color: {$this->getCor()} ;'>
            </div>";
    }
}
