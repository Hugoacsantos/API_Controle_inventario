<?php

namespace src\model;

class EntradaProduto {

    public int $id = 0;


    public function __construct(
         public int $id_produto,
         public int $quantidade,
         public string $data_entrada = '',
    ){}
    

}