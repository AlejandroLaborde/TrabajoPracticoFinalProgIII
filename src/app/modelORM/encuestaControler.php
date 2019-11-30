<?php

namespace App\Models\ORM;


use App\Models\ORM\encuesta;
use App\Models;

include_once __DIR__ . '/encuesta.php';



class encuestaControler {

    public function nuevaEncuesta($request,$response,$args){
        $parametros=$request->getParsedBody();
        $encuesta = new encuesta;
        $encuesta->codigo= $parametros['codigo'] ;
        $encuesta->puntos_mesa=$parametros["puntos_mesa"];
        $encuesta->puntos_restaurante=$parametros["puntos_restaurante"];
        $encuesta->puntos_mozo=$parametros["puntos_mozo"];
        $encuesta->puntos_cocinero=$parametros["puntos_cocinero"];
        $encuesta->comentarios=$parametros["comentarios"];
        $encuesta->save();
        return $response->withJson("la encuesta fue guardada");
    }

    public function verEncuestas($request,$response,$args){

        $newResponse = $response->withJson(encuesta::all(),200); 
        return $newResponse;
    }


    public function validaParametosEntrada($request,$response,$next){

        $parametros=$request->getParsedBody();

        if(isset($parametros["codigo"]) && isset($parametros["puntos_mesa"]) && isset($parametros["puntos_restaurante"]) && isset($parametros["puntos_mozo"]) && isset($parametros["puntos_cocinero"]) && isset($parametros["comentarios"]))
        {
            $newResponse=$next($request,$response);

        }else{
            $mensaje=["mensaje"=>"Debe setear  el token y setear los parametros"];
            $newResponse = $response->withJson($mensaje,500); 
        }
        
        return $newResponse;
    }

}