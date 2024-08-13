<?php
    require_once("Database.class.php");

class Unidade{
    private $id;
    private $descricao;

    public function __construct(int $id = 0, String $descricao = "Descricao") {
        $this->setId($id);
        $this->setdescricao($descricao);
    }
    /*setters*/
    public function setId($id){
        if ($id < 0)
            throw new Exception("Erro: id inválido!"); //dispara uma exceção
        else
            $this->id = $id;
    }

    public function setDescricao($descricao){
        if($descricao == null)
            throw new Exception("Erro: descricao inválido!"); //dispara uma exceção    
        else
            $this->descricao = $descricao;}

    /*getters*/
    public function getId(){
        return $this->id;}

    public function getDescricao(){
        return $this->descricao;}



    static public function listar($atributos = array()){
        $sql = "SELECT * FROM unidade ";

        if(!empty($atributos)){
            
            $sql .= " WHERE ";
            $entrou = false;

            foreach($atributos as $key => $atributo){
                $coluna = str_replace(":", "", $key);
                
                if(!$entrou){
                    $sql .= " $coluna = $key";
                    $entrou = true;
                }
                else
                    $sql .= " OR $coluna = $key";
            }
        }
        $comando = Database::executar($sql, $atributos);
        $unidades = array();
        while($registro = $comando->fetch()){
            $unidade = new Unidade($registro["id"], $registro['descricao']);
            array_push($unidades, $unidade);
        }

        return $unidades;
    }

    public function inserir(){
        $sql = "INSERT INTO unidade (descricao) VALUES (:descricao)";
        $atributos = [
            ":descricao" => $this->getDescricao()
            ];

        return Database::executar($sql, $atributos);
    }

    static public function editar($id){
        $sql = "SELECT * FROM unidade WHERE id = :id";
        $atributos = [":id"=>$id];

        $unidade = Database::executar($sql, $atributos);
        $registro = $unidade->fetch();
        return new Unidade($registro['id'], $registro['descricao']);
    }

    public function atualizar(){
        $atributos = [
            ":id" => $this->getId(),
            "descricao" => $this->getDescricao()
        ];
        $sql = "UPDATE unidade SET descricao = :descricao WHERE id = :id";
        return Database::executar($sql, $atributos);
    }

    static public function excluir($id){
        $sql = "DELETE FROM unidade WHERE id = :id";
        return Database::executar($sql, [":id" => $id]);
    }

}
?>