<?php

namespace src\services;

use Exception;
use src\Dao\EntradaDao;
use src\Dao\ProdutoDao;
use src\model\EntradaProduto;

class EntradaService {

    private EntradaDao $entradaDao;
    private ProdutoDao $produtoDao;

    public function __construct(EntradaDao $entradaDao, ProdutoDao $produtoDao)
    {
        $this->entradaDao = $entradaDao;
        $this->produtoDao = $produtoDao;
    }

    public function criarEntrada(EntradaProduto $entradaProduto){
        $produto = $this->produtoDao->encontrarPorID($entradaProduto->id_produto);
        if(!isset($produto)){
            return throw new Exception("Produto nao existe");
        }
        
        if($entradaProduto->quantidade < 0 ){
            return throw new Exception("Quantidade deve ser maior que 0");
        }
        
        $this->entradaDao->adicionarEntrada($entradaProduto);
        $adicionarQuantidade = $entradaProduto->quantidade + $produto->quantidade;
        $produto->quatidade = $adicionarQuantidade;
        $this->produtoDao->editar($produto);

    }


}