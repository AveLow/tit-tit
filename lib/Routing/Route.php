<?php
namespace Tit\lib\Routing;

/**
 * Class Route
 * @package Tit\lib\Routing
 *
 * Class representing a Route
 * Route are in an other file
 * Default file : src/config/routing.json
 */
class Route{

    /**
     * Method HTTP used by the route
     * Take value in :
     *  GET, POST, PUT, DELETE, HEAD, PATCH, OPTIONS
     *
     * @var string
     */
    private $method;

    /**
     * Url of the route
     * For "http://www.example.fr/this-url.html"
     * $url is "/this-url.html"
     *
     * @var string
     */
    private $url;

    /**
     * Name of the controller called by the route
     * This name must be in the container
     *
     * @var string
     */
    private $controller;

    /**
     * Name of the action called by the route
     *
     * @var string
     */
    private $action;

    /**
     * Name of the route
     *
     * @var string
     */
    private $name;

    /**
     * @param string $method Take value in : GET, POST, PUT, DELETE, HEAD, PATCH, OPTIONS
     * @return Route
     * @throws \UnexpectedValueException
     */
    public function setMethod(string $method): Route{
        if (in_array($method, ['GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'PATCH', 'OPTIONS'])){
            $this->method = $method;
            return $this;
        }else{
            throw new \UnexpectedValueException('Method is not accepted by slim');
        }
    }

    /**
     * @param string $url
     * @return Route
     */
    public function setUrl(string $url): Route{
        $this->url = $url;
        return $this;
    }

    /**
     * @param string $controller
     * @return Route
     */
    public function setController(string $controller): Route{
        $this->controller = $controller;
        return $this;
    }

    /**
     * @param string $action
     * @return Route
     */
    public function setAction(string $action): Route{
        $this->action = $action;
        return $this;
    }

    /**
     * @param string $name
     * @return Route
     */
    public function setName(string $name): Route{
        $this->name = $name;
        return $this;
    }

    /**
     * Getter
     * @return string
     */
    public function method(): string{ return $this->method; }

    /**
     * Getter
     * @return string
     */
    public function url(): string{ return $this->url; }

    /**
     * Getter
     * @return string
     */
    public function controller(): string{ return $this->controller; }

    /**
     * Getter
     * @return string
     */
    public function action(): string{ return $this->action; }

    /**
     * Getter
     * @return string
     */
    public function name(): string{ return $this->name; }
}
