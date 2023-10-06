<?php

namespace src\model;

class Produto {
    
    public int|string|null $id;
    
    public function __construct(
        public string $titulo = '',
        public string $quantidade = '',
        public float $valor = 0.0,
    ){}

    
    public function totalDoProduto(){
        return $this->valor * $this->quantidade;
    }

}

