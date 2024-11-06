<?php
/**
 * Classe Database responsável pela conexão e execução de comandos no banco de dados.
 */
class Database {
    /**
     * @var PDO $pdo Instância de conexão com o banco de dados.
     */
    private static $pdo;

    /**
     * Estabelece a conexão com o banco de dados usando PDO.
     * Caso já exista uma conexão, retorna a instância existente.
     *
     * @return PDO Instância de conexão com o banco de dados.
     */
    private static function conectar() {
        if (!isset(self::$pdo)) {
            // Configurações de conexão
            $dsn = 'pgsql:host=127.0.0.1;dbname=pessoa'; // DSN do PostgreSQL
            $usuario = 'postgres';                      // Usuário do banco
            $senha = 'postgres';                        // Senha do banco

            // Cria uma nova conexão PDO
            self::$pdo = new PDO($dsn, $usuario, $senha);
        }
        return self::$pdo;
    }

    /**
     * Executa uma consulta SQL no banco de dados.
     *
     * @param string $sql Instrução SQL a ser executada.
     * @param array $parametros Parâmetros para a consulta (opcional).
     * @return PDOStatement|bool Retorna o objeto PDOStatement se a execução for bem-sucedida, ou False em caso de falha.
     */
    public static function executar($sql, $parametros = []) {
        // Prepara a consulta e executa com os parâmetros fornecidos
        $comando = self::conectar()->prepare($sql);
        return $comando->execute($parametros) ? $comando : false;
    }
}
?>
