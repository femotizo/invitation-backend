<?php

    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    $app->get('/auth/{token}', function(Request $request, Response $response, $args){
        $config     = new Config;
        $mysqli     = new Database($config);
        $tokenize   = new Token($mysqli);
        $token      = $args['token'];

        if($tokenize->validate($token)) {
            
            $newResponse        = $response
                ->withHeader('Content-Type', $config->get()['contentType'])
                ->withAddedHeader('Access-Control-Allow-Origin', $config->get()['frontend'])
                ->withAddedHeader('Allow','GET');

            $body = $response->getBody();
            $responseBody = array(
                'name'      => $tokenize->getTokenDetails($token)['name'],
                'address'   => $tokenize->getTokenDetails($token)['address'],
                'language'  => $tokenize->getTokenDetails($token)['language']
            );

            $body->write(json_encode($responseBody));
            $tokenize->updateTokenStatus($token, 'open');
        } else {
            $newResponse        = $response
                ->withHeader('Content-Type', $config->get()['contentType'])
                ->withAddedHeader('Access-Control-Allow-Origin', $config->get()['frontend'])
                ->withAddedHeader('Allow','GET');

            $body = $response->getBody();
            $responseBody = array(
                'status'    => 'failed',
                'message'   => 'Your Invitation Not Found'
            );

            $body->write(json_encode($responseBody));
        }
        return $newResponse;
    });