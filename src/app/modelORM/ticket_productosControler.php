<?php
namespace App\Models\ORM;
use App\Models\ORM\producto;
use App\Models\ORM\ticket_producto;

include_once __DIR__ . '/ticket_producto.php';



class ticket_productosControler{

    public function traerTodos(){

        return ticket_producto::all();
    }

    
    public function verPendientes($codigo,$encargadoID){

        if($encargadoID==5){
            $data=ticket_producto::join('productos','ticket_productos.producto','productos.id')
            ->join('roles','roles.id','productos.encargado')
            ->where('ticket_productos.estado','=','1')
            ->where('codigo','=',$codigo)
            ->get();    
        }else{
            $data=ticket_producto::join('productos','ticket_productos.producto','productos.id')
            ->join('roles','roles.id','productos.encargado')
            ->where('ticket_productos.estado','=','1')
            ->where('productos.encargado','=',$encargadoID)
            ->where('codigo','=',$codigo)
            //->select(array('codigo','descripcion','puesto'))
            ->get();
        }

        return $data;
    }

    public function cambiarEstado($codigo,$encargadoID,$estadoInicial,$estadoactual){
        $ret=false;
        $data=ticket_producto::where('estado','=',$estadoInicial)
            ->where('codigo','=',$codigo)
            ->get();

        foreach($data as $value){
            $prod=producto::where('id','=',$value->producto)->first();
            if($prod->encargado == $encargadoID){
                $value->estado=$estadoactual;
                $value->save();
                $ret=true;
            }
        }   
        return $ret;
    }

    public function estadoTodosProductos($codigo){
        //retorna en que estado estan los productos de un pedido
    }

    



}