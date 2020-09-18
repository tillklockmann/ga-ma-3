<?php

return function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/all', 'all');
    $r->addRoute('GET', '/', 'home');
    $r->addRoute('GET', '/gallery/{name}', 'gallery');
    
};