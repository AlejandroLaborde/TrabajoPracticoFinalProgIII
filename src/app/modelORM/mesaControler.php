<?php

namespace App\Models\ORM;


use App\Models\ORM\mesa;
use App\Models\IApiControler;
use App\Models;

include_once __DIR__ . '/mesa.php';


class mesaControler {


    public function devuelveMesaLibre(){
        $mesaLibre=mesa::where('estado','7')->first();
        if(isset($mesaLibre)){
            return $mesaLibre->id;
        }else
        {
            return 0;
        }
    }

    public function cambiaEstado($codMesa,$nuevoEstado){
        $mesa=mesa::where('id','=',$codMesa)->first();
        $mesa->estado=$nuevoEstado;
        $mesa->save();
    }


}