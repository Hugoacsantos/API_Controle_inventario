<?php 

namespace src\model;

class SaidaProduto {
    
    public int $id;


    public function __construct(
        public int $id_produto,
        public int $quantidade,
        public string $data_saida = '',
    ){}
}