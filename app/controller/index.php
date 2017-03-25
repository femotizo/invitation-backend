<?php

    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    $app->get('/', function(Request $request, Response $response) {
        $newResponse = $response
            ->withHeader('Content-Type', 'application/json')
            ->withAddedHeader('Access-Control-Allow-Origin','*')
            ->withAddedHeader('Allow','GET');
        
        $body = $response->getBody();
        $responseBody = array(
            'status'    => 'Online'
        );

        $body->write(json_encode($responseBody));

        return $newResponse;
    });