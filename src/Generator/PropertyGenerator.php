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
    const ANNOTATION_START  = '\n   /**\n   * @var ';
    const ANNOTATION_END    = '\n   */';
    const TAG_START         = '\n   protected $';
    const TAG_END           = ';\n\n';
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
                        .self::ANNOTATION_START 
                        .($object->getIsClass()
                            ?$this->convertToPascalCase($object->getName())
                                :$object->getType()
                        )
                        .self::ANNOTATION_END
                        .self::TAG_START
                        .$object->getName()
                        .self::TAG_END;
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
