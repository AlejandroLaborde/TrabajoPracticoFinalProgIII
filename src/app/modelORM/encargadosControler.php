<?php

namespace App\Models\ORM;


use App\Models\ORM\encargado;
use App\Models\IApiControler;
use App\Models;
use App\Models\AutentificadorJWT;

include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';
include_once __DIR__ . '/encargado.php';



class encargadosControler {

    public function altaUsuario($request,$response,$args){
        try{
            $datos=$request->getParsedBody();
            $encargado = new encargado();
            $encargado->nombre=$datos["nombre"];
            $encargado->apellido=$datos["apellido"];
            $encargado->rol=$datos["rol"];
            $encargado->usuario=$datos["usuario"];
            $encargado->clave=$datos["clave"];
            $encargado->save();
            
            $newResponse = $response->withJson($encargado
            ->where('usuario',$datos["usuario"])
            ->where('clave',$datos["clave"])
            ->select(array('nombre','apellido','usuario'))->get()); 

        }catch(Exception $e){
            $newResponse = $response->withJson("Error al dar de alta usuario" . $e->getMessage()); 
        }
        return $newResponse;

    }

    public function logIn($request,$response,$args){

        try{
            $datos=$request->getParams();
            
            $query=encargado::where('usuario','=',$datos["usuario"])
            ->join('roles','encargados.rol','roles.id')
            ->get();
    
            if( $datos["usuario"]==$query[0]->usuario && $datos["clave"]==$query[0]->clave){

                $datos=[];
                $hash=new \stdClass();
                $hash->nombre=$query[0]->nombre;
                $hash->apellido=$query[0]->apellido;
                $hash->usuario=$query[0]->usuario;
                $hash->codRol=$query[0]->rol;
                $hash->puesto=$query[0]->puesto;
                $token= AutentificadorJWT::CrearToken((array)$hash); 
                $newResponse = $response->withJson($token, 200); 

            }else{
                $newResponse = $response->withJson("No se pudo validar, usuario o contraseña incorrectos", 200); 
            }
        
        }catch(Exception $e){
            $newResponse = $response->withJson("Error al intentar logIn", 200); 
        }

        return  $newResponse;

    }

    public function bajaUsuario($request,$response,$args){
        $request->getParsedBody();
        return $response;

    }

    
   
  
    
}
