<?php
namespace App\Models\ORM;
use App\Models\AutentificadorJWT;


include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';


class middleware{

    public function validaToken($request,$response,$next){
        
        $token=$request->getHeader('token');
        if(!empty($token)){
            if(AutentificadorJWT::VerificarToken($token[0])){
                $response = $next( $request, $response);
            }else{
                $mensaje=["mensaje"=>"Token enviado invalido"];
                $response = $response->withJson($mensaje,500);
            }
        }else{
            $mensaje=["mensaje"=>"Debe completar el Header token"];
            $response = $response->withJson($mensaje,500);
        }
        return $response;
    }

    public function validaSocio($request,$response,$next){
        
        $token=$request->getHeader('token');
        $datos=AutentificadorJWT::ObtenerData($token[0]);
        if( $datos->codRol == 5){
            $response = $next( $request, $response);
        }else{
            $mensaje=["mensaje"=>"Token debe ser de un socio"];
            $response = $response->withJson($mensaje,500);
        }
        return $response;
    }

    public function validaSocioMozo($request,$response,$next){
        
        $token=$request->getHeader('token');
        $datos=AutentificadorJWT::ObtenerData($token[0]);
        if( $datos->codRol == 5){
            $response = $next( $request, $response);
        }else{
            $mensaje=["mensaje"=>"Token debe ser de un socio o mozo"];
            $response = $response->withJson($mensaje,500);
        }
        return $response;
    }

    
}