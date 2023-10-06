<?php

namespace src\Dao;

use Exception;
use src\Dao\interfaces\SaidaInterfaceDao;
use src\model\SaidaProduto;

class SaidaDao implements SaidaInterfaceDao {

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function saidaDeProduto(SaidaProduto $saida): void{
        $id = md5(time() * rand(1, 9999));
       
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