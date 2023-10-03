<?php

namespace src\model;

class Produto {

    // public int $id;
    // public string $titulo;
    // public string $quantidade;
    // public float $valor;
    
    public function __construct(
        public int $id = 0,
        public string $titulo = '',
        public string $quantidade = '',
        public float $valor = 0,
    ){}

    
    public function totalDoProduto(){
        return $this->valor * $this->quantidade;
    }

}

