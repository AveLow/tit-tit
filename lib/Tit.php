<?php
namespace Tit\lib;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\App;
use Slim\Container;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Tit\lib\Components\SessionHandler;
use Tit\lib\Components\CookieHandler;

use Tit\lib\Routing\Router;

/**
 * Class Tit
 * @package Tit\lib
 *
 * Class that prepare all the application
 * It's the only class that need to be instantiate and run in the index.php file
 */
class Tit{

    /**
     * Slim App
     * @var App
     */
    protected $app;

    /**
     * Tit constructor.
     *
     * Builds the app and prepare it to be ready to run by :
     * 	- filling the dependency container
     * 	- adding routes to slim
     */
    public function __construct(){
        $config = $this->getConfig();

        $settings = array('settings' => $config['settings']);
        $this->app = new App($settings);

        $this->initContainer();
        $this->dependencyContainer($config['dependencyContainer']);

        $router = new Router($this->app);
        $router->loadRoutes();
    }

    /**
     * Gets the config from /config/config.json file
     * @return array
     */
    private function getConfig(){
    // For php7.1 private function getConfig(): array{
        $json = file_get_contents(dirname(__DIR__, 4)."/config/config.json");

        return json_decode($json, true);
    }

    /**
     * Fill the dependency container with the main class of Tit
     */
    private function initContainer(){
    // For php7.1 private function initContainer(): void{
        $c = $this->app->getContainer();
        $app = $this->app;

        // Slim App in the container
        $c['App'] = function(Container $c) use ($app): App{
            return $app;
        };

        // Database connection in the container
        $c['Db'] = function(Container $c): \PDO{
            $db = $c['settings']['db'];
            $pdo = new \PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['name'], $db['login'], $db['password']);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        };

        $c['SessionHandler'] = function(Container $c): SessionHandler{
            return new SessionHandler($c['Slim']);
        };

        $c['CookieHandler'] = function(Container $c): CookieHandler{
            return new CookieHandler($c['Slim']);
        };

        // Twig (template manager) in the container
        $c['Twig'] = function(Container $c): Twig{

            $config = $c['settings']['twig'];

            if ($config['cache'] != false)
                $twig = new Twig(dirname(__DIR__, 4).$config['template-path'], ['cache' => __DIR__.$config['cache']]);
            else
                $twig = new Twig(dirname(__DIR__, 4).$config['template-path'], ['cache' => false]);

            $twig->addExtension(new TwigExtension(
                $c->get('router'),
                $c->get('request')->getUri()
            ));

            return $twig;
        };

        if ($c['settings']['errors']['enableCustoms']){

            $className = $c['settings']['errors']['className'];

            $c['errorHandler'] = function (Container $c) use ($className) {
                return function ($request, $response, $exception) use ($c, $className): ResponseInterface {
                    return $c[$className]->errorHandler($request, $response, $exception);
                };
            };

            $c['notFoundHandler'] = function (Container $c) use ($className) {
                return function ($request, $response, $exception) use ($c, $className): ResponseInterface {
                    return $c[$className]->notFoundHandler($request, $response, $exception);
                };
            };

            $c['notAllowedHandler'] = function (Container $c) use ($className) {
                return function ($request, $response, $exception) use ($c, $className): ResponseInterface {
                    return $c[$className]->notAllowedHandler($request, $response, $exception);
                };
            };

            $c['phpErrorHandler'] = function (Container $c) use ($className) {
                return function ($request, $response, $exception) use ($c, $className): ResponseInterface {
                    return $c[$className]->phpErrorHandler($request, $response, $exception);
                };
            };
        }

        return;
    }

    /**
     * Adds other class in the dependency container depending on the /config/config.json file
     * @param array $dependencyContainer
     */
    private function dependencyContainer(array $dependencyContainer){
    //private function dependencyContainer(array $dependencyContainer): void{
        $c = $this->app->getContainer();

        foreach ((array) $dependencyContainer as $name => $class) {

            if (stristr($name, 'use_this_to_comment') === false){
                $c[$name] = function($c) use ($class){
                    $className = "\\src\\".$class['path'];

                    // On prépare les arguments
                    $args = array();
                    foreach((array) $class['injections'] as $inj){
                        $args[] = $c[$inj];
                    }

                    $reflection = new \ReflectionClass($className);
                    return $myClassInstance = $reflection->newInstanceArgs($args);
                };
            }
        }

        return;
    }

    /**
     * Start the application
     */
    public function run(){
    // For php7.1 public function run(): void{
        $this->app->run();
        return;
    }
}
