<?php
use FastRoute\DataGenerator\GroupCountBased as DataGeneratorGroupCountBased;
use FastRoute\RouteParser\Std;
use Symfony\Component\HttpFoundation\Request;
use Gallery\{Repo, Controller};
use Naona\View;



$container['globals'] = function ($c) {
    return Request::createFromGlobals();
};

$container['Controller'] = function ($c) {
    return new Controller($c['repo'], $c['view']);
};

$container['view'] = function ($c) {
    return new View;
};

$container['repo'] = function ($c) {
    return new Repo;
};

$container['route_parser'] = function ($c) {
    return new Std;
};
$container['data_generator'] = function ($c) {
    return new DataGeneratorGroupCountBased;
};

