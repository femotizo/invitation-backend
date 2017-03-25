<?php

    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    $app->put('/confirm', function(Request $request, Response $response){
        $config     = new Config;
        $mysqli     = new Database($config);
        $tokenize   = new Token($mysqli);
        $token      = $request->getHeader('token')[0];

        $requestData    = json_decode($request->getBody(), true);
        $confirm        = $requestData['confirm'];

        if($tokenize->validate($token)) {
            $tokenize->updateTokenStatus($token, $confirm);
            $newResponse = $response
                ->withHeader('Content-Type', $config->get()['contentType'])
                ->withAddedHeader('Access-Control-Allow-Origin',$config->get()['frontend'])
                ->withAddedHeader('Allow','PUT');
            
            $body = $response->getBody();

            $responseBody = array(
                'status'    => 'success',
                'message'   => 'Invitation Updated'
            );

            $body->write(json_encode($responseBody));
        } else {
            $newResponse = $response
                ->withHeader('Content-type', $config->get()['contentType'])
                ->withAddedHeader('Access-Control-Allow-Origin',$config->get()['frontend'])
                ->withAddedHeader('Allow','POST');

            $body = $response->getBody();

            $responseBody = array(
                'status'    => 'failed',
                'message'   => 'Your Invitation Not Found'
            );

            $body->write(json_encode($responseBody));
        }
    });