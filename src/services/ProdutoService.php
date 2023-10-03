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
        $lista = $this->produtoDao->lista();
        return $lista;
    }

    public function adicionarProduto(Produto $produtoDao){
        $titulo = $produtoDao->titulo;
        if($this->produtoDao->encontrarPorTitulo($titulo)){
            return throw new Exception("Produto ja cadastrado");
        }
        $this->produtoDao->criar($produtoDao);
        
        return true;
    }

    public function atualizar(Produto $produto){
        $id = $produto->id;
        $produtoDao = $this->produtoDao->encontrarPorID($id);
        if(!isset($produtoDao)) {
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

    public function procurarPorTitulo($titulo){
        
    }

    public function procurarPorid($id){
        
    }

}