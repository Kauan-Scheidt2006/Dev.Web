<?php
    require_once("Database.class.php");
    require_once("Unidade.class.php");
class Quadrado{
    private $id;
    private $unidade;
    private $tamanho;
    private $cor;

    public function __construct($id = 0, Unidade $unidade = new Unidade(), 
                                int $tamanho = 1, String $cor = "#000") {
                                    
        $this->setId($id);
        $this->setUnidade($unidade);
        $this->setTamanho($tamanho);
        $this->setCor($cor);
    }
    /*setters*/
    public function setId($id){
        if ($id < 0)
            throw new Exception("Erro: id inválido!"); //dispara uma exceção
        else
            $this->id = $id;
    }

    public function setUnidade($unidade){
        if(empty($unidade))
            throw new Exception("Erro: Unidade inválido!"); //dispara uma exceção    
        else
            $this->unidade = $unidade;}


    public function setTamanho($tamanho){
        if(empty($tamanho))
          throw new Exception("Erro: Tamanho inválido!"); //dispara uma exceção    
         
        else
            $this->tamanho = $tamanho;}

    public function setCor($cor){
        if(empty($cor))
            throw new Exception("Erro: Cor inválido!"); //dispara uma exceção    
        
        else
            $this->cor = $cor;}


    /*getters*/
    public function getId(){
        return $this->id;}

    public function getUnidade(){
        return $this->unidade;}

    public function getTamanho(){
        return $this->tamanho;}

    public function getCor(){
        return $this->cor;}


    /*static public function filtroUnidade($unidade_id){

        $sql = "SELECT * FROM quadrado LEFT JOIN unidade  ON quadrado.unidade_id = :unidade.id";
        $comando = Database::executar($sql, $unidade_id);

        $quadrados = array();
        while($registro = $comando->fetch()){
            $unidade = Unidade::listar(1, [":id"=>$registro['unidade_id']])[0];

            $quadrado = new Quadrado($registro['id'], $unidade, 
            $registro['tamanho'], $registro['cor']);

            array_push($quadrados, $quadrado);
        }

        return $quadrados;

        
    }*/


    static public function listar($atributos = array()){
        $sql = "SELECT * FROM quadrado";

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

        $quadrados = array();
        while($registro = $comando->fetch()){

            $unidade = Unidade::listar([":id"=>$registro['unidade_id']])[0];
            
            $quadrado = new Quadrado($registro["id"], $unidade, $registro['tamanho'], $registro['cor']);
            array_push($quadrados, $quadrado);
        }

        return $quadrados;
    }

    public function inserir(){
        $sql = "INSERT INTO quadrado (unidade_id, tamanho, cor) VALUES (:unidade, :tamanho, :cor)";
        $atributos = [
            ":unidade" => $this->getUnidade()->getId(),
            ":tamanho" => $this->getTamanho(),
            ":cor" => $this->getCor()
        ];

        return Database::executar($sql, $atributos);
    }

    static public function editar($id){
        

        $sql = "SELECT * FROM quadrado WHERE id = :id";
        $atributos = [":id"=>$id];

        $quadrado = Database::executar($sql, $atributos);
        $registro = $quadrado->fetch();

        $unidade = Unidade::listar([":id"=>$registro['unidade_id']])[0];
        
        $quadrado = new Quadrado($registro["id"], $unidade, $registro['tamanho'], $registro['cor']);
        return $quadrado;
    }

    public function atualizar(){
        $atributos = [
            ":id" => $this->getId(),
            ":unidade_id" => $this->getUnidade()->getId(),
            ":tamanho" => $this->getTamanho(),
            ":cor" => $this->getCor()
        ];
        $sql = "UPDATE quadrado SET unidade_id = :unidade_id, tamanho = :tamanho, cor = :cor WHERE id = :id";
        return Database::executar($sql, $atributos);
    }

    static public function excluir($id){
        $sql = "DELETE FROM quadrado WHERE id = :id";
        return Database::executar($sql, [":id"=>$id]);
    }

    public function desenhar(){ 
        ?>
        <div style="
            width: <?=$this->getTamanho() . $this->getUnidade()->getDescricao()?>;
            height: <?=$this->getTamanho() . $this->getUnidade()->getDescricao()?>;
            border-radius: 3%;
            background-color: <?=$this->getCor()?>">
            
        </div>
    <?php 
    }
}
?>
