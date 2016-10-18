<?php
namespace Tit\lib\Components;

use \Slim\App;
use Tit\lib\AppComponent;


/**
 * Class Manager
 * @package TiT\lib\Components
 *
 * Abstract class every manager should implement
 */
abstract class Manager extends AppComponent{

    /**
     * Connection to the database
     * @var \PDO
     */
    protected $db;

    /**
     * Manager constructor.
     * @param App $slim
     * @param \PDO $db
     */
    public function __construct(App $app, \PDO $db){
        parent::__construct($app);
        $this->db = $db;
    }

}
