<?php
require '../DB/Database.php';

class Produto{

    public int $id;
    public string $nome;
    public string $descricao;
    public int $qnt;
    public float $preco;
    public string $tipo;

    public function cadastrar(){
        $db = new Database('produtos');
        $result =  $db->insert(
                            [
                            'nome' => $this->nome,
                            'descricao' => $this->descricao,
                            'quantidade' => $this->qnt,
                            'preco' => $this->preco,
                            "tipo" => $this->tipo
                            ]
                        );
        
        if($result) {
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
            return (new Database('produtos'))->update('id_produto ='.$this->id,[
                'nome' => $this->nome,
                'descricao' => $this->descricao,
                'quantidade' => $this->qnt,
                'preco' => $this->preco,
                'tipo' => $this->tipo
            ]);
    }

    public static function buscar(){
        //FETCHALL
        return (new Database('produtos'))->select()->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscar_by_id($id){
        //FETCHALL
        return (new Database('produtos'))->select('id = '. $id)->fetchObject(self::class);
    }

    public function excluir($id){
        return (new Database('produtos'))->delete('id = '.$id);
    }

}