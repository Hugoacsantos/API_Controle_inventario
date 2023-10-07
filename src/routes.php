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
use src\services\EntradaService;
use src\services\ProdutoService;
use src\services\SaidaService;

require __DIR__ . '/../vendor/autoload.php';


$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$ProdutoDao = new ProdutoDao($pdo);
$EntradaDao = new EntradaDao($pdo);
$SaidaDao = new SaidaDao($pdo);
$ProdutoService = new ProdutoService($ProdutoDao);
$EntradaService = new EntradaService($EntradaDao,$ProdutoDao);
$SaidaService = new SaidaService($SaidaDao,$ProdutoDao);


$app->get('/', function (Request $request, Response $response, $args) use($ProdutoService) {
    
    $response->getBody()->write(json_encode($ProdutoService->listar()));
  
    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
});

$app->post('/create', function (Request $request, Response $response, $args) use($ProdutoService) {
    $dados = $request->getParsedBody();
    $titulo = $dados['titulo'];
    $quantidade = $dados['quantidade'];
    $valor = $dados['valor'];

    $novoProduto = new Produto($titulo,$quantidade,$valor);

    $ProdutoService->adicionarProduto($novoProduto);

    return $response->withStatus(200);
});


$app->put('/editar/{id}', function (Request $request, Response $response, array $args) use($ProdutoService) {
    $id = (int) $args['id'];
    $data = $request->getParsedBody();
    $titulo = $data['titulo'];
    $quantidade = (int) $data['quantidade'] ;
    $valor = floatval($data['valor']);

    $prodtudoAtualizado = new Produto($titulo,$quantidade,$valor);

    $prodtudoAtualizado->id = $id;
    $ProdutoService->atualizar($prodtudoAtualizado);

    return $response->withStatus(200);
});

$app->delete('/delete/{id}', function(Request $request, Response $response, $args) use($ProdutoService) {
    $id = $args['id'];

    $ProdutoService->deletar($id);

    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
});

$app->post('/produto/adicionar/{id}', function(Request $request, Response $response, $args) use($EntradaService) {
    $idProduto = $args['id'];
    $dados = $request->getParsedBody();
    $quantidade = $dados['quantidade'];   
    $id = rand(1,999);

    $adicionandoProduto = new EntradaProduto($id,$idProduto,$quantidade);
    $EntradaService->criarEntrada($adicionandoProduto);

    return $response->withStatus(201);
});

$app->post('/produto/retirada/{id}', function(Request $request, Response $response, $args) use($SaidaService) {
    $idProduto = $args['id'];
    $dados = $request->getParsedBody();
    $quantidade = $dados['quantidade'];
    // $id = rand(4,999);

    $SaidaProduto = new SaidaProduto($idProduto,$quantidade);
    $SaidaService->retirada($SaidaProduto);

    return $response->withStatus(201);
});


$app->get('/total', function(Request $request, Response $response) use($ProdutoService) {


    $produtos = $ProdutoService->listar();
 
    foreach($produtos as $produto){
        print_r("O produto {$produto->titulo} tem o total de {$produto->quantidade} em estoque e com o valor total em {$produto->totalDoProduto()}\n") ;
    }


    return $response;

});




$app->run();