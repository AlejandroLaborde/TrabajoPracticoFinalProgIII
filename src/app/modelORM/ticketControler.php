<?php

namespace App\Models\ORM;

use App\Models\ORM\ticket;
use App\Models\ORM\producto;
use App\Models\ORM\tiket_producto;
use App\Models\IApiControler;



include_once __DIR__ . '/ticket.php';
include_once __DIR__ . '/producto.php';
include_once __DIR__ . '/ticket_producto.php';


include_once __DIR__ . '../../modelAPI/IApiControler.php';


class ticketControler implements IApiControler{


    public function TraerUno($request, $response, $args){
        $parametros=$request->getParams();
        $codigoPedido=$parametros['codigo'];
        $codigoMesa=$parametros['mesa'];
        
        try{
            
            $rol= ticket::where('codigo',$parametros['codigo'])
            //->join('tickets_encargados','tickets.codigo','=','tickets_encargados.codTicket')
            ->join('estados','tickets.estado','estados.id')
            ->join('mesas','tickets.codMesa','mesas.id')       
            ->get();
           
            if($rol[0]->codMesa==$codigoMesa && $codigoPedido==$rol[0]->codigo){

                $ret=new ticket();
                $ret->estado=$rol[0]->estado;
                $ret->tiempo=$rol[0]->tiempo;
                
                $nuevoResp=$response->withJson($ret);
            }else
            {
                $nuevoResp=$response->withJson("La combinacion codigo - mesa es incorrecto");
            }
           
        }catch(Exception $e){
            $nuevoResp=$response->withJson("Error al leer los parametros");
        }
        
    	return $nuevoResp;
    }

    public function Estados($request, $response, $args){
        
        $rol= ticket::where('tickets.id','!=',0)
        ->join('estados','tickets.estado','estados.id')
        ->join('mesas','tickets.codMesa','mesas.id')
        ->select(array('tickets.codigo','estados.estado'))
        ->get();
        $nuevoRetorno= $response->withJson($rol,200);
    	return $nuevoRetorno;
    }


    public function CargarUno($request, $response, $args){

        $codigoTicket=ticketControler::generateRandomTicket();
        $body=$request->getParsedBody();
        $ticket = new ticket;
        $ticket->codigo =$codigoTicket;
        $ticket->estado = 1;
        $ticket->cliente = $body["cliente"];
        $ticket->codMesa = rand( 1, 9);
        $ticket->save();

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

        $nuevoRetorno= $response->withJson($msj);
    	return $nuevoRetorno;
    }

    
    public function TraerTodos($request, $response, $args){
        $newResponse = $response->withJson("sin completar", 200);  
    	return $nuevoResp;
    }
    public function BorrarUno($request, $response, $args){
        $newResponse = $response->withJson("sin completar", 200);  
    	return $newResponse;
    }


    public function ModificarUno($request, $response, $args){
        $newResponse = $response->withJson("sin completar", 200);  
    	return $newResponse;
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


}