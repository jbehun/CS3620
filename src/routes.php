<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/feed', function (Request $request, Response $response, array $args) {

    $feed = $this->feedcontroller;
    $messages = $feed->getMessages(6);
    return $messages;

});

$app->post('/feed', function (Request $request, Response $response, array $args) {

    $data = $request->getParsedBody();
    $this->logger->info("Message post request $data'/' route");

    $feed = $this->feedcontroller;
    $feed->addMessage($data);
    $message = $feed->getMessages(6);
    return $message;



});

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("tweet-away '/' route");


    if ($args['name'] == NULL) {
        $ip = $this->ip;
        $user = $this->usercontroller;
        $getUserName = (array)$user->getuser("127.125.125.125");

        if ($getUserName['name'] != '') {

            $args = $getUserName;
            return $this->renderer->render($response, 'index.html', $args);
        }
    }

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);

});


$app->get('/api/test', function (Request $request, Response $response, array $args) {
    
});

