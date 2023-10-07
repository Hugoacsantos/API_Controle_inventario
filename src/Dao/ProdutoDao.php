<?php

namespace src\Dao;

use PDO;
use src\Dao\interfaces\ProdutoInterfaceDao;
use src\model\Produto;

class ProdutoDao implements ProdutoInterfaceDao {
 
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function criar(Produto $produto): bool{
        $sql = $this->pdo->prepare("INSERT INTO produtos (titulo,quantidade,valor) VALUES (:titulo,:quantidade,:valor)");
        $sql->bindValue(':titulo',$produto->titulo);
        $sql->bindValue(':quantidade',$produto->quantidade);
        $sql->bindValue(':valor',$produto->valor);
        $sql->execute();
        return true;
    }

    public function listar(): array {
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

    public function deletar(int $id): void{
        $sql = $this->pdo->prepare("DELETE from produtos WHERE id = :id");
        $sql->bindValue(':id',$id);
        $sql->execute();
    }

    public function encontrarPorID($id): Produto|bool{
        $sql = $this->pdo->prepare("SELECT * FROM produtos WHERE id = :id");
        $sql->bindValue(':id',$id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch();
            $produto = new Produto($data['titulo'],$data['quantidade'],$data['valor']);
            $produto->id = $data['id'];
            return $produto;
        }
        
        return false;
    }

    public function encontrarPorTitulo(string $titulo): Produto|bool{
        $sql = $this->pdo->prepare("SELECT * FROM produtos WHERE titulo = :titulo");
        $sql->bindValue(':titulo',$titulo);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch();
            $produto = new Produto($data['titulo'],$data['quantidade'],$data['valor']);
            $produto->id = $data['id'];
            return $produto;
        }
        
        return false;
    }
    
    public function editar(Produto $produto):bool {
        $sql = $this->pdo->prepare("UPDATE produtos SET titulo = :titulo , quantidade = :quantidade, valor = :valor WHERE id = :id");
        $sql->bindValue(':id', $produto->id);
        $sql->bindValue(':titulo',$produto->titulo);
        $sql->bindValue(':quantidade', $produto->quantidade);
        $sql->bindValue(':valor', $produto->valor);
        $sql->execute();

        return true;
    }

}



