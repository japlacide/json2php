<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Generator;

/**
 * Description of MethodGenerate
 *
 * @author MarcosAlexandrede
 */
class MethodGenerator extends AbstractGenerator {
    const __METHODS 
        = '\n   /**'
        . '\n   *  @param %(type)s'
        . '\n   */'
        . '\n   public function set%(nameCC)s(%(type)s $%(var)s) {'
        . '\n       $this->%(var)s = $%(var)s;'
        . '\n   }'
        . '\n'
        . '\n   /**'
        . '\n   *  @return %(type)s'
        . '\n   */'
        . '\n   public function get%(nameCC)s() {'
        . '\n       return $this->%(var)s;'
        . '\n   }'
        . '\n';

    protected $arrayMethod = array();

    public function __construct(array $param) {
        parent::__construct();
        $this->arrayClass = $param;
        if (!$this->hasArrayClass()) {
            throw new Exception('Array is not empty!');
        }
        $this->prepareProperty();
        
    }

    private function prepareProperty() {
        foreach ($this->arrayClass as $className => $objectArray) {
            foreach ($objectArray as $object) {
                $this->arrayMethod[$className] = $this->getIfIsSet($this->arrayMethod, $className). 
                    str_replace("%(var)s", $object->getName(), 
                        str_replace("%(nameCC)s",
                            $this->convertToPascalCase($object->getName()),
                            str_replace("%(type)s", ($object->getIsClass() 
                                    ? $this->convertToPascalCase($object->getName()) 
                                    : $object->getType()), self::__METHODS)));
            }
        }
        
    }
    
    public function getArrayMethod() {
        return $this->arrayMethod;
    }
    
    public function getItemArrayMethod($key) {
        return $this->getIfIsSet($this->arrayMethod, $key);
    }

}
