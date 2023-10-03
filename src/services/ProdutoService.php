<?php

namespace src\services;

use Exception;
use src\Dao\ProdutoDao;
use src\model\Produto;

class ProdutoServices {
    
    private ProdutoDao $produtoDao;

    public function __construct(ProdutoDao $produtoDao)
    {
        $this->produtoDao = $produtoDao;
    }
    
    public function listar(){
        $lista = $this->produtoDao->lista();
    }

    public function adicionarProduto(Produto $produtoDao){
        $titulo = $produtoDao->titulo;
        if($this->produtoDao->encontrarPorTitulo($titulo)){
            return throw new Exception("Produto ja cadastrado");
        }
        $this->produtoDao->criar($produtoDao);
        
        return true;
    }

    public function procurarPorTitulo($titulo){
        
    }

    public function procurarPorid($id){
        
    

    }

}