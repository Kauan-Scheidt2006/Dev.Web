<?php
require_once('Database.class.php');

/**
 * Classe Pessoa que representa uma entidade pessoa no sistema.
 */
class Pessoa {
    private $id;         // ID único da pessoa
    private $nome;       // Nome da pessoa
    private $telefone;   // Telefone da pessoa

    /**
     * Construtor da classe Pessoa.
     *
     * @param int $id ID da pessoa (padrão 0).
     * @param string $nome Nome da pessoa (padrão vazio).
     * @param string $telefone Telefone da pessoa (padrão vazio).
     */
    public function __construct($id = 0, $nome = "", $telefone = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->telefone = $telefone;
    }

    // Getters e Setters

    /**
     * Retorna o ID da pessoa.
     *
     * @return int ID da pessoa.
     */
    public function getId() { return $this->id; }

    /**
     * Retorna o nome da pessoa.
     *
     * @return string Nome da pessoa.
     */
    public function getNome() { return $this->nome; }

    /**
     * Define o nome da pessoa.
     *
     * @param string $nome Novo nome da pessoa.
     */
    public function setNome($nome) { $this->nome = $nome; }

    /**
     * Retorna o telefone da pessoa.
     *
     * @return string Telefone da pessoa.
     */
    public function getTelefone() { return $this->telefone; }

    /**
     * Define o telefone da pessoa.
     *
     * @param string $telefone Novo telefone da pessoa.
     */
    public function setTelefone($telefone) { $this->telefone = $telefone; }

    // Métodos de CRUD

    /**
     * Adiciona uma nova pessoa no banco de dados.
     *
     * @return bool True se a inserção foi bem-sucedida, False caso contrário.
     */
    public function incluir() {
        $sql = 'INSERT INTO pessoas (nome, telefone) VALUES (:nome, :telefone)';
        $parametros = [':nome' => $this->getNome(), ':telefone' => $this->getTelefone()];
        return Database::executar($sql, $parametros);
    }

    /**
     * Atualiza os dados de uma pessoa existente no banco de dados.
     *
     * @throws Exception Se o ID for inválido (menor ou igual a 0).
     * @return bool True se a atualização foi bem-sucedida, False caso contrário.
     */
    public function alterar() {
        if ($this->getId() <= 0) {
            throw new Exception("Erro: ID inválido.");
        }
        $sql = 'UPDATE pessoas SET nome = :nome, telefone = :telefone WHERE id = :id';
        $parametros = [
            ':id' => $this->getId(),
            ':nome' => $this->getNome(),
            ':telefone' => $this->getTelefone()
        ];
        return Database::executar($sql, $parametros);
    }

    /**
     * Lista todas as pessoas do banco de dados, opcionalmente aplicando filtros.
     *
     * @param array $filtros Filtros opcionais no formato chave => valor.
     * @return array Lista de objetos Pessoa.
     */
    public static function listar($filtros = []) {
        $sql = 'SELECT * FROM pessoas';
        if (!empty($filtros)) {
            $sql .= ' WHERE ' . implode(' AND ', array_map(fn($f) => "$f = :$f", array_keys($filtros)));
        }
        $comando = Database::executar($sql, $filtros);
        $pessoas = [];
        while ($registro = $comando->fetch(PDO::FETCH_ASSOC)) {
            $pessoa = new Pessoa($registro['id'], $registro['nome'], $registro['telefone']);
            array_push($pessoas, $pessoa);
        }
        return $pessoas;
    }

    /**
     * Exclui uma pessoa do banco de dados.
     *
     * @param int $id ID da pessoa a ser excluída.
     * @throws Exception Se o ID for inválido (menor ou igual a 0).
     * @return bool True se a exclusão foi bem-sucedida, False caso contrário.
     */
    public static function excluir($id) {
        if ($id <= 0) {
            throw new Exception("Erro: ID inválido.");
        }
        $sql = 'DELETE FROM pessoas WHERE id = :id';
        return Database::executar($sql, [':id' => $id]);
    }
}
?>
