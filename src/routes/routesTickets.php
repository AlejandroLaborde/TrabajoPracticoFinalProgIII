<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\ticketControler;

include_once __DIR__ . '/../../src/app/modelORM/ticketControler.php';

return function (App $app) {
    $container = $app->getContainer();

	$app->group('/tickets', function(){

        //recibe un ticket completo
        $this->post('/nuevoTicket', ticketControler::class. ':CargarTicket');

        //recibe un ticket completo
        $this->get('/obtenerTicket', ticketControler::class . ':TraerTicket');
        
        //recibe 2 parametros
        $this->get('/estadosTickets', ticketControler::class . ':EstadosTickets');

        //se entrega el pedido
        $this->post('/servirTicket', ticketControler::class . ':servirTicket');

        //pide cuenta
        $this->get('/pedirCuenta', ticketControler::class . ':pedirCuenta');//solo lo puedo hacer un socio/mozo
        
        //cobrar ticket
        $this->get('/cobrarTicket', ticketControler::class . ':cobrarTicket');//solo lo puede hacer el socio

    });

};