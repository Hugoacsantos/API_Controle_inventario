<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use src\Dao\EntradaDao;
use src\Dao\ProdutoDao;
use src\Dao\SaidaDao;
use src\model\EntradaProduto;
use src\model\Produto;
use src\model\SaidaProduto;
use src\services\ProdutoServices;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$ProdutoDao = new ProdutoDao($pdo);
$ProdutoService = new ProdutoServices($ProdutoDao);

$app->get('/', function (Request $request, Response $response, $args) use($ProdutoService) {
    
    $response->getBody()->write(json_encode($ProdutoService->listar()));
  
    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});

$app->post('/create', function (Request $request, Response $response, $args) use($ProdutoDao) {
    $dados = $request->getParsedBody();
    $titulo = $dados['titulo'];
    $quantidade = $dados['quantidade'];
    $valor = $dados['valor'];

    $novoProduto = new Produto();
    $novoProduto->titulo = $titulo;
    $novoProduto->quantidade = $quantidade;
    $novoProduto->valor = $valor;
    $ProdutoDao->criar($novoProduto);    

    return $response->withStatus(200);
});

$app->delete('/delete/{id}', function(Request $request, Response $response, $args) use($ProdutoDao) {
    $id = $args['id'];

    $ProdutoDao->deletar($id);

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
});

$app->post('/produto/adicionar/{id}', function(Request $request, Response $response, $args) use($pdo) {
    $idProduto = $args['id'];
    $dados = $request->getParsedBody();
    $quantidade = $dados['quantidade'];   

    $adicionandoProduto = new EntradaProduto();
    $adicionandoProduto->id_produto = $idProduto;
    $adicionandoProduto->quantidade = $quantidade;
    
    $produtoDao = new EntradaDao($pdo);
    $produtoDao->adicionarEntrada($adicionandoProduto);


    return $response->withStatus(201);
});

$app->post('/produto/retirada/{id}', function(Request $request, Response $response, $args) use($pdo) {
    $idProduto = $args['id'];
    $dados = $request->getParsedBody();
    $quantidade = $dados['quantidade'];

    $retiraValor = new SaidaProduto();
    $retiraValor->id_produto = $idProduto;
    $retiraValor->quantidade = $quantidade;

    $produtoDao = new SaidaDao($pdo);
    $produtoDao->saidaDeProduto($retiraValor);
    

    return $response->withStatus(201);
});


$app->get('/total', function(Request $request, Response $response) use($ProdutoDao) {


    $produtos = $ProdutoDao->lista();
 
    foreach($produtos as $produto){
        print_r("O produto {$produto->titulo} tem o total de {$produto->quantidade} em estoque e com o valor total em {$produto->totalDoProduto()}\n") ;
    }


    return $response;

});




$app->run();