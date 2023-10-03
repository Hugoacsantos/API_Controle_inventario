<?php

namespace src\model;

class Produto {

    public ?int $id;
    public string $titulo;
    public string $quantidade;
    public float $valor;
    
    // public function __construct(
    //     string $titulo = '',
    //     string $quantidade = '',
    //     float $valor = 0,
    // )
    // {
    //     $this->titulo = $titulo;
    //     $this->quantidade = $quantidade;
    //     $this->valor = $valor;
    // }

    
    public function totalDoProduto(){
        return $this->valor * $this->quantidade;
    }

}

