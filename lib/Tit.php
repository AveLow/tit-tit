<?php
namespace Tit\lib;

use Slim\App;
use Slim\Container;
use Slim\Views\Twig;
use Tit\lib\Components\SessionHandler;
use Tit\lib\Components\CookieHandler;

use Tit\lib\Routing\Router;
use Tit\lib\Twig\TitTwigExtension;


class Tit{

    /**
     * Slim App
     * @var App
     */
    protected $app;

    /**
     * Tit init.
     *
     * Builds the app and prepare it to be ready to run by :
     * 	- filling the dependency container
     * 	- adding routes to slim
     *
     * @param array $config
     * @param array $routings
     * @param array $depencyContainers
     */
    public function init(array $config, array $routings, array $depencyContainers){

        $settings = array('settings' => $config['settings']);
        $this->app = new App($settings);

        $this->initContainer();

        foreach((array)$depencyContainers as $dependencyContainer){
            $this->dependencyContainer($dependencyContainer);
        }

        $router = new Router($this->app);
        foreach((array)$routings as $routing){
            $router->loadRoutes($routing);
        }
    }

    /**
     * Fill the dependency container with the main class of Tit
     */
    private function initContainer(){
        // For php7.1 private function initContainer(): void{
        $c = $this->app->getContainer();
        $app = $this->app;

        // Slim App in the container
        $c['App'] = function() use ($app){
            return $app;
        };

        // Database connection in the container
        $c['Db'] = function(Container $c){
            $db = $c['settings']['db'];
            $pdo = new \PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['name'], $db['login'], $db['password']);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        };

        $c['SessionHandler'] = function(Container $c){
            $session = $c['settings']['session'];
            return new SessionHandler($c['App'], $session['name'], $session['limit'], $session['path'], $session['domain'], $session['secure']);
        };

        $c['CookieHandler'] = function(Container $c){
            return new CookieHandler($c['App']);
        };

        // Twig (template manager) in the container
        $c['Twig'] = function(Container $c){

            $config = $c['settings']['twig'];

            if ($config['cache'] != false)
                $twig = new Twig(dirname(__DIR__, 4).$config['template-path'], ['cache' => __DIR__.$config['cache']]);
            else
                $twig = new Twig(dirname(__DIR__, 4).$config['template-path'], ['cache' => false]);

            $twig->addExtension(new TitTwigExtension(
                $c->get('router'),
                $c->get('request')->getUri(),
                $c
            ));

            return $twig;
        };

        if ($c['settings']['errors']['enableCustoms']){

            $className = $c['settings']['errors']['className'];

            $c['errorHandler'] = function (Container $c) use ($className) {
                return function ($request, $response, $exception) use ($c, $className) {
                    return $c[$className]->errorHandler($request, $response, $exception);
                };
            };

            $c['notFoundHandler'] = function (Container $c) use ($className) {
                return function ($request, $response) use ($c, $className) {
                    return $c[$className]->notFoundHandler($request, $response);
                };
            };

            $c['notAllowedHandler'] = function (Container $c) use ($className) {
                return function ($request, $response, $allowedMethods) use ($c, $className) {
                    return $c[$className]->notAllowedHandler($request, $response, $allowedMethods);
                };
            };

            $c['phpErrorHandler'] = function (Container $c) use ($className) {
                return function ($request, $response, $throwable) use ($c, $className) {
                    return $c[$className]->phpErrorHandler($request, $response, $throwable);
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

            if (stristr($name, '###') === false){
                $c[$name] = function($c) use ($class){
                    $className = $class['path'];

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
     * @param array $config
     * @param array $routings
     * @param array $dependencyContainers
     */
    public function run(array $config, array $routings, array $dependencyContainers){
        // For php7.1 public function run(): void{

        $this->init($config, $routings, $dependencyContainers);
        $this->app->run();
        return;
    }

    /**
     * Getter
     * @return App
     */
    public function app(){
        return $this->app;
    }
}
