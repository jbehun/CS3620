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

$app->post('/user', function (Request $request, Response $response, array $args){

    $ip = $this->ip;
    $newUser = $request->getParsedBody();
    $userController = $this->usercontroller;
    $userController->adduser($ip,$newUser['name']);
    $getAddedUser = $userController->getUser($ip);
    return $getAddedUser;


});

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("tweet-away '/' route");

    if ($args['name'] == NULL) {
        $ip = $this->ip;
        $user = $this->usercontroller;
        $getUserName = json_decode($user->getuser($ip), true);

        if ($getUserName != NULL) {
            $args = $getUserName;
            return $this->renderer->render($response, 'index.html', $args);
        }
    }

    // Render index view
    return $this->renderer->render($response, 'index.html', $args);

});


$app->get('/api/test', function (Request $request, Response $response, array $args) {

    print_r($_SERVER);
    print_r($_SESSION);
    
});

