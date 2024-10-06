<?php
require_once("../classes/Database.class.php");
require_once("../classes/UnidadeMedida.class.php");
require_once("../classes/Formas.class.php");

class Quadrado extends Formas {
    private $lado;

    // Construtor
    public function __construct($id = 0, $lado = 0, $cor = null, UnidadeMedida $un = null, $fundo = null) {
        parent::__construct($id, $cor, $un, $fundo);
        $this->setLado($lado);
    }

    // Setter com validação
    public function setLado($lado) {
        if ($lado <= 0) {
            throw new Exception("Erro: O lado do quadrado deve ser maior que zero.");
        }
        $this->lado = $lado;
    }

    // Getter
    public function getLado() {
        return $this->lado;
    }

    // Método para incluir o quadrado no banco de dados
    public function incluir() {
        $sql = 'INSERT INTO quadrado (lado, cor, id_unidade, fundo) VALUES (:lado, :cor, :id_unidade, :fundo)';
        $parametros = [
            ':lado' => $this->getLado(),
            ':cor' => $this->getCor(),
            ':id_unidade' => $this->getUnidade()->getId(),
            ':fundo' => $this->getFundo()
        ];

        return Database::executar($sql, $parametros);
    }

    // Método para excluir o quadrado
    public static function excluir($id) {
        $sql = 'DELETE FROM quadrado WHERE id = :id';
        $parametros = [':id' => $id];
        return Database::executar($sql, $parametros);
    }

    // Método para alterar o quadrado
    public function alterar() {
        $sql = 'UPDATE quadrado SET lado = :lado, cor = :cor, id_unidade = :id_unidade, fundo = :fundo WHERE id = :id';
        $parametros = [
            ':id' => $this->getId(),
            ':lado' => $this->getLado(),
            ':cor' => $this->getCor(),
            ':id_unidade' => $this->getUnidade()->getId(),
            ':fundo' => $this->getFundo()
        ];

        return Database::executar($sql, $parametros);
    }

    // Método estático para listar quadrados
    public static function listar($atributos = []) {
        $sql = "SELECT * FROM quadrado";

        if (!empty($atributos)) {
            $sql .= " WHERE ";
            $condicoes = [];

            foreach ($atributos as $key => $valor) {
                $coluna = str_replace(":", "", $key);
                $condicoes[] = "$coluna = $key";
            }

            $sql .= implode(" OR ", $condicoes);
        }

        $comando = Database::executar($sql, $atributos);
        $quadrados = [];

        while ($registro = $comando->fetch(PDO::FETCH_ASSOC)) {
            $un = UnidadeMedida::listar([":id" => $registro['id_unidade']])[0];

            $quadrado = new Quadrado(
                $registro['id'],
                $registro['lado'],
                $registro['cor'],
                $un,
                $registro['fundo']
            );
            array_push($quadrados, $quadrado);
        }

        return $quadrados;
    }

    // Método para desenhar o quadrado
    public function desenhar() {
        return '
        <div style="display:block; 
            width:' . $this->getLado() . $this->getUnidade()->getDescricao() . ';
            height:' . $this->getLado() . $this->getUnidade()->getDescricao() . ';
            background-color:' . $this->getCor() . ';
            background-image:url(' . $this->getFundo() . ');
            border:5px solid #000;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);">
        </div>';
    }

    // Método para calcular a área do quadrado
    public function calcularArea() {
        return $this->getLado() * $this->getLado();
    }

    // Método para calcular o perímetro do quadrado
    public function calcularPerimetro() {
        return 4 * $this->getLado();
    }

    // Método para apresentar o desenvolvimento do cálculo da área
    public function desenvolverCalculoArea() {
        return "Área = Lado²<br>" .
               "Área = " . $this->getLado() . " * " . $this->getLado() . "<br>" .
               "Área = " . $this->calcularArea() . " " . $this->getUnidade()->getDescricao() . "²";
    }

    // Método para apresentar o desenvolvimento do cálculo do perímetro
    public function desenvolverCalculoPerimetro() {
        return "Perímetro = 4 * Lado<br>" .
               "Perímetro = 4 * " . $this->getLado() . "<br>" .
               "Perímetro = " . $this->calcularPerimetro() . " " . $this->getUnidade()->getDescricao();
    }
}
