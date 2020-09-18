<?php
namespace Gallery;

use FastRoute;
use FastRoute\DataGenerator;
use Psr\Container\ContainerInterface;
use FastRoute\RouteParser\Std;
use FastRoute\Dispatcher\RegexBasedAbstract;
use FastRoute\DataGenerator\GroupCountBased as DataGeneratorGroupCountBased;
use Symfony\Component\HttpFoundation\Request;

class Router extends RegexBasedAbstract implements DataGenerator
{
    protected $request;

    /**
     * @var DataGeneratorGroupCountBased
     */
    protected $dataGenerator;

    /** @var Std */
    protected $routeParser;

    /** @var View */
    protected $view;

    /** @var Repo */
    protected $repo;

    /** @var Request */
    protected $request_globals;

    public function __construct(ContainerInterface $c)
    {
         $this->request_globals = $c->get('globals');
         $this->uri = $this->request_globals->getPathInfo();
         $this->method = $this->request_globals->server->get('REQUEST_METHOD');
         $this->dataGenerator = $c->get('data_generator');
         $this->routeParser = $c->get('route_parser');
         $this->view = $c->get('view');
         $this->repo = $c->get('repo');
    }

    public function addRoute($httpMethod, $routeData, $handler) { 

    }

    public function getData() { 
        // var_dump($this->dataGenerator->getData());
        return $this->dataGenerator->getData();
    }

    public function get(string $route, string $handler)
    {
        $routeData = $this->routeParser->parse($route);
        $this->dataGenerator->addRoute('GET',$routeData[0], $handler);
    }

    public function post(string $route, string $handler)
    {
        $routeData = $this->routeParser->parse($route);
        $this->dataGenerator->addRoute('POST',$routeData[0], $handler);
    }
    
    public function run()
    {
        list($this->staticRouteMap, $this->variableRouteData) = $this->getData();
        $routeInfo = $this->dispatch($this->method, $this->uri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                $this->view->template('not-found-404')->render();
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                $this->view->template('method-not-allowed')->render();
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = explode('@', $routeInfo[1]);
                $class = $handler[0];
                $method = $handler[1];
                $controller = new $class($this->repo, $this->view);
                if (empty($routeInfo[2])) {
                    $controller->{$method}($this->request_globals);
                } else {
                    // with args
                    $controller->{$method}($this->request_globals, $routeInfo[2]);
                }
                break;
        }
    }

   
    protected function dispatchVariableRoute($routeData, $uri)
    {
        foreach ($routeData as $data) {
            if (!preg_match($data['regex'], $uri, $matches)) {
                continue;
            }

            list($handler, $varNames) = $data['routeMap'][count($matches)];

            $vars = [];
            $i = 0;
            foreach ($varNames as $varName) {
                $vars[$varName] = $matches[++$i];
            }
            return [self::FOUND, $handler, $vars];
        }

        return [self::NOT_FOUND];
    }
}