<?php
namespace Tit\lib\Components;

use Slim\App;
use Tit\lib\AppComponent;
use Tit\lib\Security\SessionManager;

/**
 * Class SessionHandler
 * @package Tit\lib\Components
 *
 * Class to make easier session uses
 */
class SessionHandler extends AppComponent{

    /**
     * SessionHandler constructor.
     * Start Session
     * @param App $app
     * @param string $name
     * @param int $limit
     * @param string $path
     * @param string|null $domain
     * @param bool|null $secure
     */
    public function __construct(App $app, string $name, int $limit, string $path, string $domain = null, bool $secure = null){
        parent::__construct($app);
        SessionManager::sessionStart($name, $limit, $path, $domain, $secure);
    }

    /**
     * Sets a session param with a specific value
     * @param string $name the name of the param
     * @param mixed $value the value of the param
     */
    public function set(string $name, $value){
    // For php7.1 public function set(string $name,mixed $value): void{
        $_SESSION[$name] = $value;
        return;
    }

    /**
     * Get the value of a session param
     * @param string $name name of the param
     * @param mixed|null $default default value if param doesn't exist
     * @return mixed
     */
    public function get(string $name, $default = null){
    // For php7.1 public function get(string $name, mixed $default = null): mixed{
        return isset($_SESSION[$name]) ? $_SESSION[$name] : $default;
    }

    /**
     * Unset a session param
     * @param string $name
     */
    public function unset(string $name){
    //For php7.1 public function unset(string $name): void{
        if (isset($_SESSION[$name]))
            unset($_SESSION[$name]);
        return;
    }

    /**
     * Authenticate the user with a token in a session param
     * @param int $id_user
     */
    public function authenticate(int $id_user){
    // For php7.1 public function authenticate(int $id_user): void{
        $this->set('id_user', $id_user);
        $this->set('connected', true);
        return;
    }

    /**
     * Disconnect the user
     */
    public function disconnect(){
    // For php7.1 public function disconnect(): void{
        $this->unset('id_user');
        $this->unset('connected');
        return;
    }

    /**
     * Checks if there is a connected user
     * @return bool
     */
    public function isConnected(){
    // For php7.1 public function isConnected(): bool{
        return (bool) $this->get('connected');
    }

    /**
     * Return the token session for the connected user
     * @return string
     */
    public function getConnectedId(){
    // For php7.1 public function getConnectedId(): string{
        return (string)$this->get('id_user');
    }

}
