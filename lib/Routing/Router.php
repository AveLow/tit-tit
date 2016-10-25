<?php
namespace Tit\lib\Routing;

use Tit\lib\AppComponent;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Class Router
 * @package Tit\lib\Routing
 *
 * Class making the link between Slim router and /config/routing.json file
 */
class Router extends AppComponent{

    /**
     * loads routes from the /config/routing.json file and adds routes to slim
     */

    public function loadRoutes(){
    // For php7.1 public function loadRoutes(): void{
        $json = file_get_contents(dirname(__DIR__, 2)."/config/routing.json");
        $routesArray = json_decode($json, true);

        foreach ((array) $routesArray as $name => $r){
            if (stristr($name, 'itsacomment') === false){
                $route = new Route();
                $route->setMethod($r['method'])
                    ->setUrl($r['url'])
                    ->setController($r['controller'])
                    ->setAction($r['action'])
                    ->setName($name);

                $m = $route->method();
                $app = $this->app;

                $app->$m($route->url(), function(Request $req, Response $resp, $args) use ($app, $route){
                    // get the controller in the container
                    $c = $app->getContainer();
                    $ctrl = $c[$route->controller()];
                    // start the action from the controller
                    $action = $route->action();
                    // Action is called in the method exec
                    return $ctrl->exec($action, $req, $resp, $args);
                })->setName($route->name());
            }
        }
        return;
    }

}
