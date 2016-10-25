<?php
namespace Tit\lib\Entity;

/**
 * Class Hydratable
 * @package Tit\lib\Entity
 *
 * Give the a class the possibility to be hydrated
 */
trait Hydratable{

    /**
     * Hydrate the entity (set all the data into his fields)
     * @param array $data
     */
    protected function hydrate(array $data){
    // For php7.1 protected function hydrate(array $data): void{
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
        return;
    }
}
