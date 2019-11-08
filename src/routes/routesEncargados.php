<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\encargadosControler;

include_once __DIR__ . '/../../src/app/modelORM/encargadosControler.php';

return function (App $app) {
    $container = $app->getContainer();

	$app->group('/encargados', function(){

        $this->get('/logIn', encargadosControler::class . ':logIn');

        $this->post('/altaEncargado', encargadosControler::class . ':altaUsuario');

        $this->get('/BajaEncargado', function($re,$res,$args){
            return $res->withJson("BajaEncargado",200);
        });


    });

};
