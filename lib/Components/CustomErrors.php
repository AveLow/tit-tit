<?php
namespace Tit\lib\Components;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tit\lib\AppComponent;


/**
 * Class CustomErrors
 * @package Tit\lib\Components
 *
 * Abstract class for custom errors handling
 */
abstract class CustomErrorsHandler extends AppComponent{

    abstract public function errorHandler(RequestInterface $request, ResponseInterface $response,\Exception $exception);
    // For php7.1 abstract public function errorHandler($request, $response, $exception): ResponseInterface;

    abstract public function notFoundHandler(RequestInterface $request, ResponseInterface $response,\Exception $exception);
    // For php7.1 abstract public function notFoundHandler($request, $response, $exception): ResponseInterface;

    abstract public function notAllowedHandler(RequestInterface $request, ResponseInterface $response,\Exception $exception);
    // For php7.1 abstract public function notAllowedHandler($request, $response, $exception): ResponseInterface;

    abstract public function phpErrorHandler(RequestInterface $request, ResponseInterface $response,\Exception $exception);
    // For php7.1 abstract public function phpErrorHandler($request, $response, $exception): ResponseInterface;


}
