<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\productosControler;
use App\Models\ORM\middleware;
include_once __DIR__ . '/../../src/app/modelORM/middleware.php';
include_once __DIR__ . '/../../src/app/modelORM/productosControler.php';

return function (App $app) {
    $container = $app->getContainer();

	$app->group('/preparacion', function(){


        $this->get('/prepararPedido', productosControler::class . ':prepararPedido')->add(middleware::class . ":validaToken");
        
        $this->get('/verPendientes', productosControler::class . ':verPendientes')->add(middleware::class . ":validaToken");
        
        $this->get('/finalizarPedido', productosControler::class . ':finalizarPedido')->add(middleware::class . ":validaToken");

        $this->get('/eliminarPedido', productosControler::class . ':eliminarPedido')->add(middleware::class . ":validaToken");

    });

};
