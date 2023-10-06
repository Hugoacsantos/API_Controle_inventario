<?php

namespace src\Dao\interfaces;

use src\model\SaidaProduto;

interface SaidaInterfaceDao {

    public function saidaDeProduto(SaidaProduto $saida): void;

}