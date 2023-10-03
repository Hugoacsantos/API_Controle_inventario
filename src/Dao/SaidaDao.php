<?php

namespace src\Dao;

use Exception;
use src\model\SaidaProduto;

class SaidaDao {

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function saidaDeProduto(SaidaProduto $saida){
        $produtodados = new ProdutoDao($this->pdo);
        $produto = $produtodados->encontrarPorID($saida->id_produto);
        
        
        if($produto->quantidade < 0){
            throw new Exception("Erro,Quantidade do produto esta vazia");
        }

        $quantidadeSaida = $produto->quantidade - $saida->quantidade;
        if($quantidadeSaida < 0 ){
            return $quantidadeSaida = 0;
        }
        $saidaProduto = $this->pdo->prepare("UPDATE produtos SET quantidade = :quantidade WHERE id = :id");
        $saidaProduto->bindValue(':id',$saida->id_produto);
        $saidaProduto->bindValue(':quantidade', $quantidadeSaida);
        $saidaProduto->execute();        
        

        $retirar = $this->pdo->prepare("INSERT INTO saidas (id,id_produto,quantidade) VALUES (:id,:id_produto,:quantidade)");
        $id = md5(time() * rand(9,999));
        $retirar->bindValue(":id",$id);
        $retirar->bindValue(":id_produto", $saida->id_produto);
        $retirar->bindValue(":quantidade",$saida->quantidade);
        $retirar->execute();

    }


}
// public int $id;
// public int $id_produto;
// public int $quantidade;
// public string $data_saida;