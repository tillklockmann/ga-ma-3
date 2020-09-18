<?php
use FastRoute\DataGenerator\GroupCountBased as DataGeneratorGroupCountBased;
use Symfony\Component\HttpFoundation\Request;
use Gallery\Repo;
use Gallery\View;
use FastRoute\RouteParser\Std;



$container['globals'] = function ($c) {
    return Request::createFromGlobals();
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

