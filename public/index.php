<?php

require '../vendor/autoload.php';


use Route66\Router;
use Pimple\Psr11\Container as PsrContainer;

$container = new Pimple\Container;

require '../src/dependencies.php';
$app = new Router(
    new PsrContainer($container)
);

$app->get('/', 'Controller@home');
$app->get('/gallery/{name}', 'Controller@gallery');
$app->post('/upload/{name}', 'Controller@upload');
$app->post('/new-folder', 'Controller@newFolder');

$app->run();
