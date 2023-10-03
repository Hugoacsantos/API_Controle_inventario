<?php

namespace src\model;

class EntradaProduto {

    // public int $id;
    // public int $id_produto;
    // public int $quantidade;
    // public string $data_entrada;

    public function __construct(
         public int $id,
         public int $id_produto,
         public int $quantidade,
         public float|int $preco_unidade,
         public string $data_entrada,
    ){}
    

}