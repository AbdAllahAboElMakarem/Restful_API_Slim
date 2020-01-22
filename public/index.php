<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
});

$app->get('/id/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $response->getBody()->write("Hello, $id");
    return $response;
});

$app->post('/tast/{name}', function (Request $a1, Request $a2){
$data=$a1->getParsedBody();
$inputdata=[];
$inputdata['name']=filter_var($data['name'], FILTER_SANITIZE_STRING);
$inputdata['id']=filter_var($data['id'], FILTER_SANITIZE_STRING);
$a2->getBody()->write('daer ' .$inputdata['name'].'your phone unmber is ' .$inputdata['phone']);

});

$app->get('/testargs/{Name}/{phone}', function ($request,$response, array $args) {
    $Name = $args['Name'];
    $phone = $args['phone'];
    $response->getBody()->write("thes is a test for args, $Name you phone numbor is $phone");
    return $response;
});


$app->run();