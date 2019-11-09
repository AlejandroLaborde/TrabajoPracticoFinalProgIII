<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\productosControler;

include_once __DIR__ . '/../../src/app/modelORM/productosControler.php';

return function (App $app) {
    $container = $app->getContainer();

	$app->group('/preparacion', function(){


        $this->get('/prepararPedido', productosControler::class . ':prepararPedido');
        
        $this->get('/verPendientes', productosControler::class . ':verPendientes');
        
        $this->get('/finalizarPedido', productosControler::class . ':finalizarPedido');

        $this->get('/eliminarPedido', productosControler::class . ':eliminarPedido');

    });

};
