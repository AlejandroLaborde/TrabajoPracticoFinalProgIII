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

    public function prepararPedido($request, $response, $args ){

        $token=$request->getHeader('token');
        $parametros= $request->getParams();
        $datos=AutentificadorJWT::ObtenerData($token[0]);
        $respuesta=ticket_productosControler::cambiarEstado($parametros["codigo"],$datos->codRol,2);
        $newResponse= $response->withJson($respuesta,200);
        return $newResponse;
    }


    public function verPendientes($request,$response,$args)
    {
        $token=$request->getHeader('token');
        $parametros= $request->getParams();
        $datos=AutentificadorJWT::ObtenerData($token[0]);
        $respuesta=ticket_productosControler::verPendientes($parametros["codigo"],$datos->codRol);
        $newResponse= $response->withJson($respuesta,200);
        return $newResponse;
    }

    public function finalizarPedido($request,$response,$args){
        return $response;
    }







}