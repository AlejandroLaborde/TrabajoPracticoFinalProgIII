<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\ticketControler;
use App\Models\ORM\middleware;

include_once __DIR__ . '/../../src/app/modelORM/ticketControler.php';
include_once __DIR__ . '/../../src/app/modelORM/middleware.php';


return function (App $app) {
    $container = $app->getContainer();


  $app->group('/tickets', function(){

      //recibe un ticket completo
      $this->get('/obtenerTicket', ticketControler::class . ':TraerTicket');

  });

	$app->group('/tickets', function(){

    //recibe un ticket completo
    $this->post('/nuevoTicket', ticketControler::class. ':CargarTicket')->add(middleware::class . ":validaSocioMozo");
    
    //recibe un codigo y elimina todo si es de tipo socio el token
    $this->post('/eliminarTicket', ticketControler::class . ':eliminarTicket')->add(middleware::class . ":validaSocio");
    
    //recibe 2 parametros
    $this->get('/estadosTickets', ticketControler::class . ':EstadosTickets')->add(middleware::class . ":validaSocio");

    //se entrega el pedido
    $this->post('/servirTicket', ticketControler::class . ':servirTicket')->add(middleware::class . ":validaSocioMozo");

    //pide cuenta
    $this->get('/pedirCuenta', ticketControler::class . ':pedirCuenta')->add(middleware::class . ":validaSocioMozo");//solo lo puedo hacer un socio/mozo
    
    //cobrar ticket
    $this->get('/cobrarTicket', ticketControler::class . ':cobrarTicket')->add(middleware::class . ":validaSocio");//solo lo puede hacer el socio

    })->add(middleware::class . ":validaToken");

};