<?php
namespace App\Models\ORM;
use App\Models\ORM\producto;
use App\Models\ORM\ticket_producto;
use App\Models\ORM\ticketControler;
use App\Models\ORM\ticket_productosControler;

include_once __DIR__ . '/producto.php';
include_once __DIR__ . '/ticket_producto.php';
include_once __DIR__ . '/ticket_productosControler.php';
include_once __DIR__ . '/ticketControler.php';


class productosControler{

    public function tomarPedido($request, $response, $args ){

        $parametros=$request->getParams();
        ticketControler::cambiarEstado("XFNXO",2);
        ticketControler::cambiaTiempo("XFNXO");
        //ticketControler::calculaPrecio("XFNXO");
        print(ticket_productosControler::traerTodos());


        return $request;
    }








}