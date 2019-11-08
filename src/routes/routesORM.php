<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\cd;
use App\Models\ORM\cdApi;
use App\Models\ORM\role;
use App\Models\ORM\rolControler;


include_once __DIR__ . '/../../src/app/modelORM/role.php';
include_once __DIR__ . '/../../src/app/modelORM/rolControler.php';

return function (App $app) {
    $container = $app->getContainer();

    $app->group('/cdORM', function () {   
         
        $this->get('/', function ($request, $response, $args) {
          //return cd::all()->toJson();
        $todosLosCds=cd::all();
        $newResponse = $response->withJson($todosLosCds, 200);  
          return $newResponse;
        });

        $this->get('/todosRoles/', rolControler::class . ':TraerUno');

    });

    

    $app->group('/cdORM2', function () {   

      $this->get('/',cdApi::class . ':traerTodos');
   
    });

};