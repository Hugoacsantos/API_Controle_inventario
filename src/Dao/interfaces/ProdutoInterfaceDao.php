<?php

namespace src\Dao\interfaces;


use src\model\Produto;

interface ProdutoInterfaceDao {

    public function criar(Produto $produto):bool;

    public function listar(): array;

    public function deletar(int $id): void;

    public function encontrarPorID(int $id): Produto|bool;

    public function encontrarPorTitulo(string $titulo): Produto|bool;

    public function editar(Produto $produto): bool;

}