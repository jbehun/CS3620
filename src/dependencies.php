<?php
// DIC configuration
$container = $app->getContainer();
// view renderer
$container['renderer'] = function() use ($container) {
    $settings = $container->get('settings')['renderer'];
    return new \Slim\Views\PhpRenderer($settings['template_path']);
};
// database
$container['db'] = function() use ($container) {
    $settings = $container->get('settings')['db'];
    $dsn = 'mysql:dbname='.$settings['dbname'].
        ';host='.$settings['host'].
        ';port='.$settings['port'];
    $db = new \PDO($dsn, $settings['username'], $settings['password']);
    return $db;
};
// monolog
$container['logger'] = function() use ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
$container['usercontroller'] = function () use ($container){
    return new \App\UserController($container['db'], $container['logger']);
};
$container['feedcontroller'] = function () use ($container){
    return new \App\FeedController($container['db'], $container['logger']);
};
$container['ip'] = function () use ($container){
    return $_SERVER['REMOTE_ADDR'];
};
