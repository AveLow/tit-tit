<?php
namespace Tit\lib\Components;

use Psr\Http\Message\ResponseInterface;
use Slim\App;
use Tit\lib\AppComponent;
use Slim\Views\Twig;

use Slim\Http\Response;
use Slim\Http\Request;
use Interop\Container\ContainerInterface;

/**
 * Class Controller
 * @package Tit\lib\Components
 *
 * Abstract class for every controller implementing a constructor and a dependency container attribute and twig attribute
 */
abstract class Controller extends AppComponent{

    /**
     * App container
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Template manager twig
     *
     * @var Twig
     */
    protected $twig;

    /**
     * Controller constructor.
     * @param App $app
     */
    public function __construct(App $app){
        parent::__construct($app);
        $this->container = $app->getContainer();
        $this->twig = $this->container['Twig'];
    }

    /**
     * Function that execute the action
     * It can be override to add some function before the execution of the action
     *
     * @param string $action
     * @param Request $req
     * @param Response $resp
     * @param array $args
     * @return ResponseInterface
     * @throws \BadMethodCallException
     */
    public function exec(string $action,Request $req, Response $resp, array $args){
    // For php7.1 public function exec(string $action,Request $req, Response $resp, array $args): ResponseInterface{
            if (!method_exists($this, $action))
            throw new \BadMethodCallException("This action doesn't exist.");
        else {
            return $this->$action($req, $resp, $args);
        }
    }
}
