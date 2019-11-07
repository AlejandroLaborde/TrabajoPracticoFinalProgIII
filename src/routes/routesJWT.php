<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\AutentificadorJWT;


include_once __DIR__ . '/../app/modelAPI/AutentificadorJWT.php';


return function (App $app) {
    $container = $app->getContainer();

		
/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/token', function () {   


    $this->post('/altaUsuario', function (Request $request, Response $response) {
      $datos=$request->getParsedBody();
      var_dump($datos);
      $datos = array('usuario' => 'rogelio@agua.com','perfil' => 'Administrador', 'alias' => "PinkBoy");
     //$datos = array('usuario' => 'rogelio@agua.com','perfil' => 'profe', 'alias' => "PinkBoy");
      
      $token= AutentificadorJWT::CrearToken($datos); 
      $newResponse = $response->withJson($token, 200); 
      return $newResponse;
    });


    
     
});



};
