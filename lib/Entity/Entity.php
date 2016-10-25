<?php
namespace Tit\lib\Entity;

/**
 * Class Entity
 * @package Tit\lib\Entity
 *
 * Abstract class for Entity
 */
abstract class Entity{

    use Hydratable;

    /**
     * @var int
     */
    protected $id;

    /**
     * Entity constructor.
     * @param array $data
     */
    public function __construct(array $data = array()){
        $this->hydrate($data);
    }

    /**
     * @param int $id
     * @return Entity
     */
    public function setId(int $id){
    // For php7.1 public function setId(int $id): Entity{
        $this->id = $id;
        return $this;
    }

    /**
     * Getter
     * @return int
     */
    public function id(){
    // For php7.1 public function id(): int{
        return $this->id;
    }

    /**
     * An entity is new when it has an id
     * @return bool
     */
    public function isNew(){
    // For php7.1 public function isNew(): bool{
        return $this->id == null;
    }

}
