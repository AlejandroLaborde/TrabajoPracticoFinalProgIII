<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\encargadosControler;
use App\Models\ORM\middleware;

include_once __DIR__ . '/../../src/app/modelORM/encargadosControler.php';
include_once __DIR__ . '/../../src/app/modelORM/middleware.php';

return function (App $app) {
    $container = $app->getContainer();

	$app->group('/encargados', function(){

        $this->post('/logIn', encargadosControler::class . ':logIn');

        $this->post('/altaEncargado', encargadosControler::class . ':altaUsuario')->add(middleware::class . ":validaSocio")->add(middleware::class . ":validaToken");
        
        $this->get('/BajaEncargado', encargadosControler::class . ':bajaUsuario')->add(middleware::class . ":validaSocio")->add(middleware::class . ":validaToken");
        
        $this->get('/listarEncargados', encargadosControler::class . ':listarEncargados')->add(middleware::class . ":validaSocio")->add(middleware::class . ":validaToken");
    });

};
