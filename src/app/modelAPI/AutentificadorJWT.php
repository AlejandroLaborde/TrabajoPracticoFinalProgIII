<?php
namespace App\Models;
use Firebase\JWT\JWT;
use Exception;
class AutentificadorJWT
{
    private static $claveSecreta = 'ClaveSecreta2695175342382582';
    private static $tipoEncriptacion = ['HS256'];
    private static $aud = null;
    
    public static function CrearToken($datos)
    {
       
        $payload = array(
        	
            'datos'=>$datos,
            'app'=> "TrabajoPracticoLabordeParodiAlejandro"
        );
        return JWT::encode($payload, self::$claveSecreta);
    }
    
    public static function VerificarToken($token)
    {
        $valido=false;
        if(empty($token))
        {
            throw new Exception("El token esta vacio.");
        } 
      
      try {
            $decodificado = JWT::decode(
            $token,
            self::$claveSecreta,
            self::$tipoEncriptacion
        );
            $valido=true;
        } catch (\Exception $e) {
            $valido=false;
        } 
        return $valido;
    }
    
   
     public static function ObtenerPayLoad($token)
    {
        return JWT::decode(
            $token,
            AutentificadorJWT::$claveSecreta,
            AutentificadorJWT::$tipoEncriptacion
        );
    }
     public static function ObtenerData($token)
    {
        $ret= new \stdClass;
        $ret=JWT::decode($token,AutentificadorJWT::$claveSecreta,AutentificadorJWT::$tipoEncriptacion);
        return $ret->datos;
    }

}