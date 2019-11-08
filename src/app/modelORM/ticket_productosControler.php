<?php
namespace App\Models\ORM;
use App\Models\ORM\producto;
use App\Models\ORM\ticket_producto;

include_once __DIR__ . '/ticket_producto.php';



class ticket_productosControler{

    public function traerTodos(){

        return ticket_producto::all();
    }

    public function cambiarEstado($codigo,$producto,$estado){
        //cambia el estado de un producto determinado
    }

    public function estadoTodosProductos($codigo){
        //retorna en que estado estan los productos de un pedido
    }

    



}