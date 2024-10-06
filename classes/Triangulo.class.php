<?php
require_once("../classes/Database.class.php");
require_once("../classes/UnidadeMedida.class.php");
require_once("../classes/Formas.class.php");

abstract class Triangulo extends Formas {
    protected $ladoA;
    protected $ladoB;
    protected $ladoC;
    protected $trianguloTipo;

    public function __construct($id = 0, $ladoA = 0, $ladoB = 0, $ladoC = 0, $cor = null, 
    UnidadeMedida $un = null, $fundo = null, $trianguloTipo = null) {
        parent::__construct($id, $cor, $un, $fundo);
        $this->setLadoA($ladoA);
        $this->setLadoB($ladoB);
        $this->setLadoC($ladoC);
        $this->setTrianguloTipo($trianguloTipo);
    }

    // Métodos Setter e Getter
    public function getLadoA() {
        return $this->ladoA;
    }

    public function setLadoA($ladoA) {
        if ($ladoA <= 0) {
            throw new Exception("Erro: O lado A deve ser maior que zero.");
        }
        $this->ladoA = $ladoA;
    }

    public function getLadoB() {
        return $this->ladoB;
    }

    public function setLadoB($ladoB) {
        if ($ladoB <= 0) {
            throw new Exception("Erro: O lado B deve ser maior que zero.");
        }
        $this->ladoB = $ladoB;
    }

    public function getLadoC() {
        return $this->ladoC;
    }

    public function getTrianguloTipo() {
        return $this->trianguloTipo;
    }

    /** setters */
    public function setLadoC($ladoC) {
        if ($ladoC <= 0) {
            throw new Exception("Erro: O lado C deve ser maior que zero.");
        }
        $this->ladoC = $ladoC;
    }

    public function setTrianguloTipo($trianguloTipo) {
        if (empty($trianguloTipo)) {
            throw new Exception("Erro: Triângulo Inválido.");
        }
        $this->trianguloTipo = $trianguloTipo;
    }

    // Método para incluir no banco de dados
    public function incluir() {
        $sql = 'INSERT INTO triangulo (ladoA, ladoB, ladoC, cor, id_unidade, fundo, triangulotipo)   
                     VALUES (:ladoA, :ladoB, :ladoC, :cor, :id_unidade, :fundo, :triangulotipo)';
        $parametros = array(
            ':ladoA' => $this->getLadoA(),
            ':ladoB' => $this->getLadoB(),
            ':ladoC' => $this->getLadoC(),
            ':cor'   => $this->getCor(),
            ':id_unidade' => $this->getUnidade()->getId(),
            ':fundo' => $this->getFundo(),
            ':triangulotipo' => $this->getTrianguloTipo()  
        );
        return Database::executar($sql, $parametros);
    }

    // Método para listar triângulos
    public static function listar($atributos = array()) {
        $sql = "SELECT * FROM triangulo";
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
        $triangulos = array();
        while ($registro = $comando->fetch(PDO::FETCH_ASSOC)) {
            $un = UnidadeMedida::listar([":id" => $registro['id_unidade']])[0];
            // Verificação do tipo de triângulo para instanciar a classe correta
            switch ($registro['triangulotipo']) {
                case 'Equilátero':
                    $triangulo = new TrianguloEquilatero(
                        $registro['id'],
                        $registro['ladoa'],
                        $registro['ladob'],
                        $registro['ladoc'],
                        $registro['cor'],
                        $un,
                        $registro['fundo'],
                        "Equilátero"
                    );
                    break;
                case 'Isósceles':
                    $triangulo = new TrianguloIsoceles(
                        $registro['id'],
                        $registro['ladoa'],
                        $registro['ladob'],
                        $registro['ladoc'],
                        $registro['cor'],
                        $un,
                        $registro['fundo'],
                        "Isósceles"
                    );
                    break;
                case 'Escaleno':
                    $triangulo = new TrianguloEscaleno(
                        $registro['id'],
                        $registro['ladoa'],
                        $registro['ladob'],
                        $registro['ladoc'],
                        $registro['cor'],
                        $un,
                        $registro['fundo'],
                        "Escaleno",
                    );
                    break;
                default:
                    throw new Exception("Erro: Tipo de triângulo inválido!");
            }

            array_push($triangulos, $triangulo);
        }
        return $triangulos;
    }

    public function alterar() {
        if ($this->getId() <= 0) {
            throw new Exception("Erro: O ID do triângulo é inválido.");
        }
    
        $sql = "UPDATE triangulo 
                SET ladoA = :ladoA, ladoB = :ladoB, ladoC = :ladoC, cor = :cor, id_unidade = :un, fundo = :fundo, trianguloTipo = :trianguloTipo
                WHERE id = :id";
        
        $parametros = array(
            ':id'           => $this->getId(),
            ':ladoA'       => $this->getLadoA(),
            ':ladoB'       => $this->getLadoB(),
            ':ladoC'       => $this->getLadoC(),
            ':cor'         => $this->getCor(),
            ':un'          => $this->getUnidade()->getId(),
            ':fundo'       => $this->getFundo(),
            ':trianguloTipo' => $this->getTrianguloTipo() // Define o tipo de triângulo
        );
    
        return Database::executar($sql, $parametros);
    }
    

    static public function excluir($id) {
        if ($id <= 0) {
            throw new Exception("Erro: O ID do triângulo é inválido.");
        }
    
        $sql = "DELETE FROM triangulo WHERE id = :id";
        $parametros = array(
            ':id' => $id
        );
    
        return Database::executar($sql, $parametros);
    }
    
    // Métodos abstratos para serem implementados nas subclasses
    abstract public function calcularArea();
    abstract public function calcularPerimetro();
    abstract public function desenhar();
}
