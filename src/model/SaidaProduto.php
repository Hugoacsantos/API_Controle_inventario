<?php 

namespace src\model;

class SaidaProduto {
    
    public int $id;
    public int $id_produto;
    public int $quantidade;
    public string $data_saida;

    // public function __construct(
    //     int $id_produto,
    //     int $quantidade,
    //     string $data_saida,
    // )
    // {
    //     $this->id_produto = $id_produto;
    //     $this->quantidade = $quantidade;
    //     $this->data_saida = $data_saida;
    // }
}