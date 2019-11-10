<?php
namespace App\Models\ORM;
use App\Models\ORM\producto;
use App\Models\ORM\ticket_producto;
use App\Models\ORM\ticketControler;
use App\Models\ORM\ticket_productosControler;
use App\Models\AutentificadorJWT;

include_once __DIR__ . '/producto.php';
include_once __DIR__ . '/ticket_producto.php';
include_once __DIR__ . '/ticket_productosControler.php';
include_once __DIR__ . '/ticketControler.php';
include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';


class productosControler{

    
    public function verPendientes($request,$response,$args)
    {
        $token=$request->getHeader('token');
        $parametros= $request->getParams();
        $datos=AutentificadorJWT::ObtenerData($token[0]);
        $respuesta=ticket_productosControler::verPendientes($parametros["codigo"],$datos->codRol);
        $newResponse= $response->withJson($respuesta,200);
        return $newResponse;
    }

    public function prepararPedido($request, $response, $args ){

        $token=$request->getHeader('token');
        $parametros= $request->getParams();
        $datos=AutentificadorJWT::ObtenerData($token[0]);
        $respuesta=ticket_productosControler::cambiarEstado($parametros["codigo"],$datos->codRol,1,2);
        
        if($respuesta){
            $mensaje=["mensaje"=>"Comienza preparacion de los pedidos"];
            $newResponse = $response->withJson($mensaje,200);
        }else{
            $mensaje=["mensaje"=>"No habia pedidos o ya fueron tomados para preparar"];
            $newResponse= $response->withJson($mensaje,200);
        }

        return $newResponse;
    }


    public function finalizarPedido($request,$response,$args){

        $token=$request->getHeader('token');
        $parametros= $request->getParams();
        $datos=AutentificadorJWT::ObtenerData($token[0]);
        $respuesta=ticket_productosControler::cambiarEstado($parametros["codigo"],$datos->codRol,2,3);
        
        if($respuesta){

            $data=ticket_producto::where('codigo',$parametros["codigo"])->get();
            $completo=true;
            foreach($data as $value){
                if($value->estado!=3) $completo=false;
            }
            if($completo){
                ticketControler::cambiarEstado($parametros["codigo"],3);
                $mensaje=["mensaje"=>"Se finalizaron los pedidos Y el ticket esta completo"];
                $newResponse = $response->withJson($mensaje,200);
            }else{
                $mensaje=["mensaje"=>"Se finalizaron los pedidos"];
                $newResponse = $response->withJson($mensaje,200);
            }    

        }else{
            $mensaje=["mensaje"=>"No habia pedidos iniciados o ya fueron finalizados"];
            $newResponse= $response->withJson($mensaje,200);
        }

        return $newResponse;
    }







}