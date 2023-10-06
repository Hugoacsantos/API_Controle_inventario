<?php

namespace src\Dao\interfaces;

use src\model\EntradaProduto;

interface EntradaInterfaceDao {
    
    public function adicionarEntrada(EntradaProduto $entrada) : void;

}