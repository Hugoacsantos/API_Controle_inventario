<?php

namespace src\Dao;

use Exception;
use src\model\EntradaProduto;

class EntradaDao {

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function adicionarEntrada(EntradaProduto $entrada){
        $idEntrada = md5(time() * rand(9, 99999));
        $produtodados = new ProdutoDao($this->pdo);
        $produto = $produtodados->encontrarPorID($entrada->id_produto);
        
        print_r($produto);

        if($entrada->quantidade < 0){
            throw new Exception("Erro, Quantidade precisa ser maior que 0");
        }
        $quantidadeAtualizada = $entrada->quantidade + $produto->quantidade;
        $inserir = $this->pdo->prepare("UPDATE produtos SET quantidade = :quantidade WHERE id = :id");
        $inserir->bindValue(":quantidade", $quantidadeAtualizada);
        $inserir->bindValue(":id", $entrada->id_produto);
        $inserir->execute();

        
        $sql = $this->pdo->prepare("INSERT INTO entradas (id,id_produto,quantidade) 
        VALUES (:id,:id_produto,:quantidade)");
        $sql->bindValue(':id',$idEntrada);
        $sql->bindValue(':id_produto',$entrada->id_produto);
        $sql->bindValue(':quantidade',$entrada->quantidade);
        // $sql->bindValue(':preco_unidade',$entrada->preco_unidade);
        // $sql->bindValue(':data_entrada',$entrada->data_entrada);
        $sql->execute();
    }





}

// adicionar quantidade do produto por id
// adicionar valor por id

// public int $id;
// public int $id_produto;
// public int $quantidade;
// public float|int $preco_unidade;
// public string $data_entrada;


// procura o produto por id;
// vou pegar o valor e adicionar pegando o valor e adicionando;