<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Generator;
/**
 * Description of Property
 *
 * @author MarcosAlexandrede
 */
class PropertyGenerator extends AbstractGenerator{
    const __PROPERTY    
        = '\n   /**'
        . '\n   * @var %(type)s'
        . '\n   */'
        . '\n   protected $%(var)s;'
        . '\n';
    protected $arrayProperty = array();
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
                $this->arrayProperty[$className] = $this->getIfIsSet($this->arrayProperty, $className)
                        .str_replace("%(var)s", $object->getName(),
                            str_replace("%(type)s", ($object->getIsClass()
                                ? $this->convertToPascalCase($object->getName())
                                : $object->getType()), self::__PROPERTY));
            }
        }
    }
    
    
    public function getArrayProperty() {
        return $this->arrayProperty;
    }
    
    public function getItemArrayProperty($key) {
        return $this->getIfIsSet($this->arrayProperty, $key);
    }
}
