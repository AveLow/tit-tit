<?php
namespace Tit\lib;
use Slim\App;

/**
 * Class AppComponent
 * @package TiT\lib
 *
 * Abstract class representing an component of the application Tit
 */
abstract class AppComponent{

    /**
     * Object App from Slim
     * @var App
     */
    protected $app;

    /**
     * AppComponent constructor.
     * @param App $app
     */
    public function __construct(App $app){
        $this->app = $app;
    }

}
