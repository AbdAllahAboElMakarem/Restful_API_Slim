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



$app->get('/jsontast/{FerstName}/{LastName}' ,function($request ,$response ,$args){
    $FerstName = $args['FerstName'];
    $LastName = $args['LastName'];
    $out =[];
$out['Status'] = 200;
$out['Message'] = 'This is JSON Response Test';
$out['FerstName'] = $FerstName;
$out['LastName'] = $LastName;
$response->getBody()->write(json_encode($out));
});

//put

$app->put('/testput' ,function($request ,$response){

$data=$request->getParsedBody();
$username=$data['UserName'];
$password=$data['Password'];
$response->getBody()->write('$username your password is $password');

});

//Delete

$app->delete('/testdelete' ,function($request ,$response){

$data=$request->getParsedBody();
$username=$data['UserName'];
$password=$data['Password'];
$response->getBody()->write('$username your password is $password with  Delete tast demo');

});

$app->map(['PUT' ,'GET'],'/multipleMrthodsTest/{id}',function($request ,$response){

$id=$args['id'];
if ($request->isPut()){
    $response->getBody()->write('This di=$di will be updated');
}

if ($request->isGet()){
    $response->getBody()->write('This di=$di will be retrived');
}
});

$app->get('/password[/{id}]' ,function($requ ,$resp ,$args){
$id=$args['id'];
if (is_null(id)){
$requ->getBody()->write('Ths id is null');
}
else{
$resp->getBody()->write('THS $id=id');
}

});


$app->get('/password[/{year}[/{month}]]' ,function($requ ,$resp ,$args){

$year=$args['year'];
$month=$args['month'];


if (is_null(year)){
$requ->getBody()->write('Ths year and month are is null');

}
else{
if(is_null($month)){

$requ->getBody()->write('Ths year=$year month are is null');
}
else{
$requ->getBody()->write('Ths year=$year month=$month');
}}

});
$app->get('/unlimited/optional[/{parms:.*}]',function($req ,$res ,$args){
$parms=explode('/', $req->getAttribute('parms'));
        
if (empty($parms[0])){
$res->getBody()->write("The parms list is null");
}
else{
$out="";
foreach ($parms as $key => $value) {
$out=$out." " ."$key => $value";
}
$res->getBody()->write($out);	
}
});

$app->get('/regular/{id:[0-9]+}/{name:[a-z]=}',function($request ,$response ,$args){
$id=$args['id'];
$name=$args['name'];
});
$response->getBody()->write('this id=$id,the name is $name');

$app->run();