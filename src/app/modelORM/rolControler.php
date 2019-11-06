<?php

namespace App\Models\ORM;
use App\Models\ORM\role;
use App\Models\IApiControler;


include_once __DIR__ . '/role.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';


class rolControler implements IApiControler{

    public function TraerUno($request, $response, $args){
        $parametros=$request->getParams();
        $rol= role::find($parametros["id"]);
        $nuevoResp=$response->withJson($rol);
    	return $nuevoResp;
    }
    public function TraerTodos($request, $response, $args){
        $roles=role::all();
        $nuevoResp=$response->withJson($roles);
    	return $nuevoResp;
    }
    public function CargarUno($request, $response, $args){
        $newResponse = $response->withJson("sin completar", 200);  
    	return $newResponse;
    }
    public function BorrarUno($request, $response, $args){
        $newResponse = $response->withJson("sin completar", 200);  
    	return $newResponse;
    }
    public function ModificarUno($request, $response, $args){
        $newResponse = $response->withJson("sin completar", 200);  
    	return $newResponse;
    }

}