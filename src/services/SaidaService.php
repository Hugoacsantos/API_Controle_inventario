<?php

namespace src\services;

use Exception;
use src\Dao\SaidaDao;
use src\Dao\ProdutoDao;
use src\model\SaidaProduto;

class SaidaService {

    private SaidaDao $saidaDao;
    private ProdutoDao $produtoDao;

    public function __construct(SaidaDao $saidaDao, ProdutoDao $produtoDao)
    {
        $this->saidaDao = $saidaDao;
        $this->produtoDao = $produtoDao;
    }

    public function retirada(SaidaProduto $saidaProduto){
        $produto = $this->produtoDao->encontrarPorID($saidaProduto->id_produto);
        if(!isset($produto)){
            return throw new Exception("Produto nao existe");
        }

        if($saidaProduto->quantidade < 0 ){
            return throw new Exception("Quantidade deve ser maior que 0");
        }
      
        $this->saidaDao->saidaDeProduto($saidaProduto);
        $removerQuantidade = $produto->quantidade - $saidaProduto->quantidade;
        var_dump($removerQuantidade);
        exit;
        $produto->quantidade = $removerQuantidade;
        $this->produtoDao->editar($produto);
    }


}