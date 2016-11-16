<?php
namespace Tit\lib\Twig;

use Pimple\Container;
use Slim\Views\TwigExtension;

class TitTwigExtension extends TwigExtension
{
    /**
     * @var \Slim\Interfaces\RouterInterface
     */
    protected $router;

    /**
     * @var string|\Slim\Http\Uri
     */
    protected $uri;

    /** @var  Container */
    protected $container;

    public function __construct($router, $uri, Container $container)
    {
        $this->container = $container;
        parent::__construct($router, $uri);
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('path_for', array($this, 'pathFor')),
            new \Twig_SimpleFunction('base_url', array($this, 'baseUrl')),
            new \Twig_SimpleFunction('render_method', array($this, 'renderMethod'))
        ];
    }

    public function renderMethod($controller,  $method, $args){
        $ctrl = $this->container[$controller];
        return $ctrl->$method($args);
    }
}
