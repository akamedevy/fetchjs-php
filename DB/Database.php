<?php

class Database{
    public $conn;
    public string $local="localhost";
    public string $db="crudphp";
    public string $user = "root";
    public string $password = "";
    public $table;


   public function __construct($table = null){
        $this->table = $table;
        $result = $this->conecta();
    }

    public function conecta(){
        try {
            $this->conn = new PDO("mysql:host=".$this->local.";dbname=$this->db",$this->user,$this->password); 
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //echo "Conectado com Sucesso!!";
        } catch (PDOException $err) {
            //retirar msg em produção
            die("ERRO DE CONEXAO: " . $err->getMessage());
        }
    }

    
    public function execute($query,$binds = []){
        //BINDS = SELECT 
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute($binds);
            return $stmt;
        }catch (PDOException $err) {
            //retirar msg em produção
            die("Connection Failed " . $err->getMessage());
        }
    }

    public function insert($values){
        //DEBUG
        $fields = array_keys($values);
        $binds = array_pad([],count($fields),'?');

        //Montar query
        $query = 'INSERT INTO ' . $this->table .'  (' .implode(',',$fields). ') VALUES (' .implode(',',$binds).')';
        $result = $this->execute($query,array_values($values));
        
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    public function update($where,$values){
        $fields = array_keys($values);
        //Montar query
        $query = 'UPDATE ' . $this->table .' SET ' .implode('=?,',$fields). '=? WHERE ' .$where;

        $result = $this->execute($query,array_values($values));
        
        return true;
    }

    public function select($where = null,$order = null,$limit = null, $fields = '*'){
            //montando a query
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT '.$fields. ' FROM ' .$this->table. ' '.$where;
        //SELECT * FROM pessoa;
        return $this->execute($query);
    }


    public function delete($where){
        $sql = 'DELETE FROM '.$this->table.' WHERE '.$where;
        $result = $this->execute($sql);
        return true;
    }


}