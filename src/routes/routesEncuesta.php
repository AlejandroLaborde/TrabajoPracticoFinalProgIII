<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\encuestaControler;
use App\Models\ORM\middleware;

include_once __DIR__ . '/../../src/app/modelORM/middleware.php';
include_once __DIR__ . '/../../src/app/modelORM/encuestaControler.php';


return function (App $app) {
    $container = $app->getContainer();

	$app->group('/encuesta', function(){

        $this->get('/verTodas', encuestaControler::class . ':verEncuestas')->add(middleware::class . ":validaToken");
        
        $this->post('/nuevaEncuesta', encuestaControler::class . ':nuevaEncuesta')->add(encuestaControler::class . ':validaParametosEntrada');
        
    });

};
