<?php

namespace App\Models\ORM;


use App\Models\ORM\encargado;
use App\Models\IApiControler;
use App\Models\AutentificadorJWT;


include_once __DIR__ . '/../app/modelAPI/AutentificadorJWT.php';
include_once __DIR__ . '/encargado.php';

class encargadosControler {

    public function altaUsuario($request,$response,$args){
        $datos=$request->getParsedBody();
        var_dump($datos);
        $datos = array('usuario' => 'rogelio@agua.com','perfil' => 'Administrador', 'alias' => "PinkBoy");
       //$datos = array('usuario' => 'rogelio@agua.com','perfil' => 'profe', 'alias' => "PinkBoy");
        
        $token= AutentificadorJWT::CrearToken($datos); 
        $newResponse = $response->withJson($token, 200); 
        return $newResponse;

    }

    public function logIn($request,$response,$args){
        print("entro al logIn de encargados");
        return $response;

    }

    public function bajaUsuario($request,$response,$args){
        print("entro al bajaUsuario de encargados");
        return $response;

    }

    
   
  
    
}
