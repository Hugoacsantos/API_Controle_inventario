<?php

namespace src\services;

use Exception;
use src\Dao\ProdutoDao;
use src\model\Produto;

class ProdutoService {
    
    private ProdutoDao $produtoDao;

    public function __construct(ProdutoDao $produtoDao)
    {
        $this->produtoDao = $produtoDao;
    }
    
    public function listar(){
        $lista = $this->produtoDao->listar();
        return $lista;
    }

    public function adicionarProduto(Produto $produto){
        $id = md5(time() * rand(9, 999));
        $titulo = $produto->titulo;
        if($this->produtoDao->encontrarPorTitulo($titulo)){
            return throw new Exception("Produto ja cadastrado");
        }
        $produto->id = $id;
        $this->produtoDao->criar($produto);        
        return true;
    }

    public function atualizar(Produto $produto){
        $id = $produto->id;
        $produtoBanco = $this->produtoDao->encontrarPorID($id);
        if(!isset($produtoBanco)) {
            throw new Exception("Produto não existe");
        }
        $this->produtoDao->editar($produto);
    }

    public function deletar($id){
        if($id === null) {
            return throw new Exception("Id vazio");
        }
        $this->produtoDao->deletar($id);
    }


}