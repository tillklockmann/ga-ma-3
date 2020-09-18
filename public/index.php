<?php

require '../vendor/autoload.php';

use Gallery\Router;
use Pimple\Psr11\Container as PsrContainer;

$container = new Pimple\Container;

require '../src/dependencies.php';
$app = new Router(
    new PsrContainer($container)
);

$app->get('/', 'Gallery\Controller@home');
$app->get('/gallery/{name}', 'Gallery\Controller@gallery');
$app->post('/upload/{name}', 'Gallery\Controller@upload');
$app->post('/new-folder', 'Gallery\Controller@newFolder');

$app->run();
