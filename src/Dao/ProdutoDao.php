<?php

namespace src\Dao;

use PDO;
use src\model\Produto;

class ProdutoDao {
 
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function criar(Produto $produto){
        $id = md5(time() * rand(9,999));
        $sql = $this->pdo->prepare("INSERT INTO produtos (id,titulo,quantidade,valor) VALUES (:id,:titulo,:quantidade,:valor)");
        $sql->bindValue(':id',$id);
        $sql->bindValue(':titulo',$produto->titulo);
        $sql->bindValue(':quantidade',$produto->quantidade);
        $sql->bindValue(':valor',$produto->valor);
        $sql->execute();
        return true;
    }

    public function lista(){
        $array = [];
        $sql = $this->pdo->query("SELECT * FROM produtos");
        if($sql->rowCount() > 0) {
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($dados as $dado){
                $produto = new Produto();
                $produto->id = $dado['id'];
                $produto->titulo = $dado['titulo'];
                $produto->quantidade = $dado['quantidade'];
                $produto->valor = $dado['valor'];

                $array[] = $produto;
            }
        }

        return $array;
    }

    public function deletar($id){
        $sql = $this->pdo->prepare("DELETE from produtos WHERE id = :id");
        $sql->bindValue(':id',$id);
        $sql->execute();
    }

    public function encontrarPorID($id){
        $sql = $this->pdo->prepare("SELECT * FROM produtos WHERE id = :id");
        $sql->bindValue(':id',$id);
        $sql->execute();
        $dados = $sql->fetch(PDO::FETCH_OBJ);

        return $dados;
    }

    public function encontrarPorTitulo($titulo){
        $sql = $this->pdo->prepare("SELECT * FROM produtos WHERE titulo = :titulo");
        $sql->bindValue(':titulo',$titulo);
        $sql->execute();
        $dados = $sql->fetch();
        return $dados;
    }
    
    public function editar(Produto $produto){
        $sql = $this->pdo->prepare("UPDATE produtos SET titulo = :titulo , quantidade = :quantidade, valor = valor WHERE id = :id");
        $sql->bindValue(':id', $produto->id);
        $sql->bindValue(':titulo',$produto->titulo);
        $sql->bindValue(':quantidade', $produto->quantidade);
        $sql->bindValue(':valor', $produto->valor);
        $sql->execute();

        return true;
    }

    // public int $id;
    // public string $titulo;
    // public string $quantidade;
    // public string $valor;


}



