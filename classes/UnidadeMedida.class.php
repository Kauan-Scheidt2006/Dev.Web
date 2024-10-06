<?php
require_once("../classes/Database.class.php");

class UnidadeMedida {
    private $id;
    private $descricao;

    public function __construct($id = 0, $descricao = "") {
        $this->id = $id;
        $this->setDescricao($descricao);
    }

    // Getters e Setters
    public function getId() {
        return $this->id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        if (empty($descricao)) {
            throw new Exception("Erro: A descrição não pode estar vazia.");
        }
        $this->descricao = $descricao;
    }

    // Método para inserir no banco de dados
    public function incluir() {
        $sql = 'INSERT INTO unidade_medida (descricao) VALUES (:descricao)';
        $parametros = array(':descricao' => $this->getDescricao());
        return Database::executar($sql, $parametros);
    }

    // Método para atualizar no banco de dados
    public function alterar() {
        $sql = 'UPDATE unidade_medida SET descricao = :descricao WHERE id = :id';
        $parametros = array(
            ':id' => $this->getId(),
            ':descricao' => $this->getDescricao()
        );
        return Database::executar($sql, $parametros);
    }

    // Método para excluir no banco de dados
    public static function excluir($id) {
        $sql = 'DELETE FROM unidade_medida WHERE id = :id';
        $parametros = array(':id' => $id);
        return Database::executar($sql, $parametros);
    }

    // Método para listar as unidades de medida
    public static function listar($filtros = array()) {
        $sql = 'SELECT * FROM unidade_medida';
        if (!empty($filtros)) {
            $sql .= ' WHERE ';
            $primeiro = true;
            foreach ($filtros as $key => $value) {
                $coluna = str_replace(":", "", $key);
                if ($primeiro) {
                    $sql .= "$coluna = $key";
                    $primeiro = false;
                } else {
                    $sql .= " OR $coluna = $key";
                }
            }
        }

        $comando = Database::executar($sql, $filtros);
        $unidades = array();
        while ($registro = $comando->fetch(PDO::FETCH_ASSOC)) {
            $unidade = new UnidadeMedida($registro['id'], $registro['descricao']);
            array_push($unidades, $unidade);
        }
        return $unidades;
    }
}
?>
