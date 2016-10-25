<?php
namespace Tit\lib\Components;

use Slim\App;
use Tit\lib\AppComponent;

/**
 * Class SessionHandler
 * @package Tit\lib\Components
 *
 * Class to make easier session uses
 */
class SessionHandler extends AppComponent{

    /**
     * SessionHandler constructor.
     * Start session
     * @param App $app
     */
    public function __construct(App $app){
        parent::__construct($app);
        session_start();
    }

    /**
     * Sets a session param with a specific value
     * @param string $name the name of the param
     * @param mixed $value the value of the param
     */
    public function set(string $name,mixed $value){
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
    public function get(string $name, mixed $default = null){
    // For php7.1 public function get(string $name, mixed $default = null): mixed{
        return isset($_SESSION[$name]) ? $_SESSION[$name] : $default;
    }

    /**
     * Unset a session param
     * @param string $name
     */
    public function unset(string $name){
    //For php7.1 public function unset(string $name): void{
        unset($_SESSION[$name]);
        return;
    }

    /**
     * Authenticate the user with a token in a session param
     * @param string $token_session
     */
    public function authenticate(string $token_session){
    // For php7.1 public function authenticate(string $token_session): void{
        $this->set('token_session', $token_session);
        $this->set('connected', true);
        return;
    }

    /**
     * Disconnect the user
     */
    public function disconnect(){
    // For php7.1 public function disconnect(): void{
        $this->set('token_session', null);
        $this->set('connected', false);
        return;
    }

    /**
     * Checks if there is a connected user
     * @return bool
     */
    public function isConnected(){
    // For php7.1 public function isConnected(): bool{
        return $this->get('connected');
    }

    /**
     * Return the token session for the connected user
     * @return string
     */
    public function getConnectedToken(){
    // For php7.1 public function getConnectedToken(): string{
        return (string)$this->get('token_session');
    }

}
