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
        $this->post('/nuevoTicket', ticketControler::class. ':CargarUno');

        //recibe un ticket completo
        $this->get('/obtenerTicket', ticketControler::class . ':TraerUno');
        
        //recibe 2 parametros
        $this->get('/estadosTickets', ticketControler::class . ':Estados');

        //recibe ticket a cobrar
        $this->get('/cobrar', ticketControler::class . ':123');


    });

};