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
            new \Twig_SimpleFunction('render_method', array($this, 'renderMethod'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('form_token', array($this, 'formToken'), array('is_safe' => array('html')))
        ];
    }

    /**
     * @param $controller
     * @param $method
     * @param $args
     * @return String
     */
    public function renderMethod($controller,  $method, $args){
        $ctrl = $this->container[$controller];
        return $ctrl->execMethod($method, $args);
    }

    /**
     * @param $name
     * @return String
     */
    public function formToken($name){
        // On génère le token et on l'associe au nom du formulaire
        $_SESSION[$name] = bin2hex(random_bytes(32));
        return '<input type="hidden" name="'.$name.'" value="'.$_SESSION[$name].'"/>';
    }
}
