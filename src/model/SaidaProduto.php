<?php 

namespace src\model;

class SaidaProduto {
    
    // public int $id;
    // public int $id_produto;
    // public int $quantidade;
    // public string $data_saida;

    public function __construct(
        public int $id = 0,
        public int $id_produto,
        public int $quantidade,
        public string $data_saida = '',
    ){}
}