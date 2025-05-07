<?php
require './DB/Database.php';

class Cliente{

    public int $id;
    public string $nome;
    public string $cpf;
    public string $email;
    public string $foto;

    public function cadastrar(){
        $db = new Database('cliente');
        $result =  $db->insert(
                            [
                            'nome' => $this->nome,
                            'cpf' => $this->cpf,
                            'email' => $this->email,
                            'foto' => $this->foto
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
            return (new Database('cliente'))->update('id ='.$this->id,[
                'nome' => $this->nome,
                'cpf' => $this->cpf,
                'email' => $this->email
            ]);
    }

    public static function buscar(){
        //FETCHALL
        return (new Database('cliente'))->select()->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscar_by_id($id){
        //FETCHALL
        return (new Database('cliente'))->select('id = '. $id)->fetchObject(self::class);
    }

    public function excluir($id){
        return (new Database('cliente'))->delete('id = '.$id);
    }

}