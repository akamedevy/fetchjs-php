<?php

require_once '../Entity/Produto.php';

switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
        $produto = new Produto();

        $produto->nome = $_POST['nome'];
        $produto->descricao = $_POST['descricao'];
        $produto->qnt = $_POST['quantidade'];
        $produto->preco = $_POST['preco'];
        $produto->tipo = $_POST['tipo'];
        

        $result = $produto->cadastrar();
        
        if($result){

            $array = ['status' => 200];
        }
        break;

}

echo json_encode($array);