<?php
namespace Tit\lib\Components;

use Tit\lib\AppComponent;

/**
 * Class CookieHandler
 * @package Tit\lib\Components
 *
 * Class to make easier cookies uses
 */
class CookieHandler extends AppComponent{

    /**
     * Sets a cookie with a specific value
     * @param string $name
     * @param mixed $value
     * @param int|null $expires
     * @param string|null $path
     * @param string|null $domain
     * @param bool $secure
     * @param bool $httponly
     */
    public function set(string $name, $value, int $expires = null, string $path = null, string $domain = null, $secure = false, $httponly = true){
    // For php7.1 public function set(string $name, mixed $value, int $expires = null, string $path = null, string $domain = null, $secure = false, $httponly = true): void{
        if ($expires == null)
            $expires = 60*60*24*365+time();

        if ($path == null)
            $path = "";

        setcookie($name, $value, $expires, $path, $domain, $secure, $httponly);
        return;
    }

    /**
     * Destroy a cookie
     *
     * @param string $name
     */
    public function destroy(string $name){
    // For php7.1 public function destroy(string $name): void{
        setcookie($name, "", 0);
        return;
    }

    /**
     * Get a cookie value
     * @param string $name
     * @param mixed|null $default default value if the cookie doesn't exist.
     * @return mixed
     */
    public function get(string $name, $default = null){
    // For php7.1 public function get(string $name, mixed $default = null): mixed{
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : $default;
    }

    /**
     * Authenticate the user with a token in a cookie
     * @param int $selector
     * @param string $token_cookie
     */
    public function authenticate(int $selector, string $token_cookie){
    // For php7.1 public function authenticate(string $token_cookie): void{
        $this->set('token_cookie', $token_cookie);
        $this->set('token_selector', $selector);
        return;
    }

    /**
     * Disconnect the user by removing the token cookie
     */
    public function disconnect(){
    // For php7.1 public function disconnect(): void{
        $this->set('token_cookie', null);
        $this->set('token_selector', null);
        return;
    }

    /**
     * Checks if there is a connected user
     * @return bool
     */
    public function isConnected(){
    // For php7.1 public function isConnected(): bool{
        return $this->get('token_selector') != null;
    }

    /**
     * Return the token cookie for the connected user
     * @return string
     */
    public function getConnectedToken(){
    // For php7.1 public function getConnectedToken(): string{
        return (string)$this->get('token_cookie');
    }

    /**
     * Return the token cookie for the connected user
     * @return string
     */
    public function getConnectedSelector(){
    // For php7.1 public function getConnectedToken(): string{
        return (string)$this->get('token_selector');
    }
}
