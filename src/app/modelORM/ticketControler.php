<?php

namespace App\Models\ORM;

use App\Models\ORM\ticket;
use App\Models\ORM\producto;
use App\Models\ORM\tiket_producto;
use App\Models\ORM\mesa;
use App\Models\IApiControler;
use App\Models\AutentificadorJWT;

include_once __DIR__ . '../../modelAPI/AutentificadorJWT.php';
include_once __DIR__ . '/mesaControler.php';
include_once __DIR__ . '/ticket.php';
include_once __DIR__ . '/producto.php';
include_once __DIR__ . '/ticket_producto.php';
include_once __DIR__ . '../../modelAPI/IApiControler.php';


class ticketControler{


    public function TraerTicket($request, $response, $args){
        $parametros=$request->getParams();
        $codigoPedido=$parametros['codigo'];
        $codigoMesa=$parametros['mesa'];
        
        try{
            
    
            $rol= ticket::join('mesas','tickets.codMesa','mesas.id')     
            ->where('codigo',$parametros['codigo'])
            ->get();
            $estado=ticket::join('estados','tickets.estado','estados.id')     
            ->where('codigo',$parametros['codigo'])
            ->get();
            
           
            if($rol[0]->codMesa==$codigoMesa && $codigoPedido==$rol[0]->codigo){

                $ret=new ticket();
                $ret->estado=$estado[0]->estado;
                $ret->tiempo=$rol[0]->tiempo;
                
                $nuevoResp=$response->withJson($ret,200);
            }else
            {
                $nuevoResp=$response->withJson("La combinacion codigo - mesa es incorrecto");
            }
           
        }catch(Exception $e){
            $nuevoResp=$response->withJson("Error al leer los parametros");
        }
        
    	return $nuevoResp;
    }

    public function EstadosTickets($request, $response, $args){
        
        $rol= ticket::where('tickets.id','!=',0)
        ->join('estados','tickets.estado','estados.id')
        ->join('mesas','tickets.codMesa','mesas.id')
        ->select(array('tickets.codigo','estados.estado'))
        ->get();
        $nuevoRetorno= $response->withJson($rol,200);
    	return $nuevoRetorno;
    }


    public function CargarTicket($request, $response, $args){

        if(mesaControler::devuelveMesaLibre() != 0){
            $codigoTicket=ticketControler::generateRandomTicket();
            $body=$request->getParsedBody();
            $ticket = new ticket;
            $ticket->codigo =$codigoTicket;
            $ticket->estado = 1;
            $ticket->cliente = $body["cliente"];
            $ticket->codMesa = mesaControler::devuelveMesaLibre();
            $ticket->save();
            mesaControler::cambiaEstado($ticket->codMesa,4);//clientes esperando pedido
            $prod = explode(",", $body["productos"]);
            
            for($i=0;$i<count($prod);$i++){
                $producto= new ticket_producto;
                $producto->codigo=$codigoTicket;
                $producto->producto=$prod[$i];
                $producto->save();
            }
            
            $msj="La clave de su pedido es: " .$codigoTicket ;
            
            $foto=$request->getUploadedFiles();
    
            if($foto!=null){
                $nombre=$foto["imagen"]->getClientFilename();
                $extencion= explode(".",$nombre);
                $foto["imagen"]->moveTo('../src/app/imagenes/'.$codigoTicket.".".$extencion[1]);
        
            }
            ticketControler::calculaPrecio($codigoTicket);
            $nuevoRetorno= $response->withJson($msj);
        }else{
            $mensaje=["mensaje"=>"no hay mesa disponible"];
            $nuevoRetorno= $response->withJson($mensaje,200);
        }
        
    	return $nuevoRetorno;
    }

    public function servirTicket($request, $response, $args){
        $parametros= $request->getParams();
        $token=$request->getHeader('token');
        $datos=AutentificadorJWT::ObtenerData($token[0]);
        if($datos->codRol == 4){
            
            $ticket1=ticketControler::getTicket($parametros['codigo']);
            if($ticket1->estado == 3){

                ticketControler::cambiarEstado($parametros['codigo'],8);
                mesaControler::cambiaEstado($ticket1->codMesa,5);

                $mensaje=["mensaje"=>"Ticket entregado"];
                $nuevoRetorno= $response->withJson($mensaje,200);
            }else{
                $mensaje=["mensaje"=>"El ticket no se encuentra finalizado o ya fue servido, por favor chequear estado"];
                $nuevoRetorno= $response->withJson($mensaje,200);
            }
        }else{
            $mensaje=["mensaje"=>"Solo un Mozo puede realizar esta actividad"];
            $nuevoRetorno= $response->withJson($mensaje,200);
        }
        return $nuevoRetorno;
    }



    public function cambiarEstado($ticketCodigo,$estado){

        $ticket = ticket::where('codigo',$ticketCodigo)->first();
        $ticket->estado=$estado;
        if($estado=3){
            $ticket->tiempo=0;
        }
        $ticket->save();
    }

    public function cambiaTiempo($ticket){
        
        $pedido=ticket::where('codigo',$ticket)->first();
        $tiempo= ticket_producto::where('codigo',$ticket)
        ->where('ticket_productos.estado','!=','3')
        ->join('productos','ticket_productos.producto','productos.id')
        ->sum('tiempo');
        //calculo el tiempo en base a los productos del pedido que aun no terminaron
        $pedido->tiempo=$tiempo;
        $pedido->save();

    }

    public function calculaPrecio($ticket){
        $pedido=ticket::where('codigo',$ticket)->first();
        $precios= ticket_producto::where('codigo',$ticket)
        ->join('productos','ticket_productos.producto','productos.id')
        ->sum('precio');
        $pedido->precio=$precios;
        $pedido->save();
        return $precios;
    }

    public function generateRandomTicket() {
        $length=5;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getTicket($codigo){
        return ticket::where('codigo','=',$codigo)->first();
    }



    public function test($request,$response,$args){

        mesaControler::cambiaEstado(1,7);
        return $response;
    }

}