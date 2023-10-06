<?php

namespace src\Dao;

use Exception;
use src\Dao\interfaces\EntradaInterfaceDao;
use src\model\EntradaProduto;

class EntradaDao implements EntradaInterfaceDao {

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function adicionarEntrada(EntradaProduto $entrada): void {
        $id = md5(time() * rand(1, 9999));
                
        $sql = $this->pdo->prepare("INSERT INTO entradas (id,id_produto,quantidade) 
        VALUES (:id,:id_produto,:quantidade)");
        $sql->bindValue(':id',$id);
        $sql->bindValue(':id_produto',$entrada->id_produto);
        $sql->bindValue(':quantidade',$entrada->quantidade);
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