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

    const ANNOTATION_START_SET  = '\n   /**\n   * @param ';
    const ANNOTATION_END_SET    = '\n   */';
    const TAG_START             = '\n   private function ';
    const ANNOTATION_START_GET  = '\n   /**\n   * @return ';
    const ANNOTATION_END_GET    = '\n   */';
    const TAG_END               = '\n   }\n\n';

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
                $this->arrayMethod[$className] = $this->getIfIsSet($this->arrayMethod, $className)
                . self::ANNOTATION_START_SET
                . ($object->getIsClass() 
                        ? $this->convertToPascalCase($object->getName()) 
                        : $object->getType()
                )
                .self::ANNOTATION_END_SET.self::TAG_START."set"
                .$this->convertToPascalCase($object->getName())."("
                . ($object->getIsClass() 
                        ? $this->convertToPascalCase($object->getName()) 
                        : $object->getType()
                )." $".$object->getName()."){"
                .'\n      $this->'.$object->getName()." = $".$object->getName()
                .";\n".self::TAG_END.self::ANNOTATION_START_GET
                . ($object->getIsClass() 
                        ? $this->convertToPascalCase($object->getName()) 
                        : $object->getType()
                ).self::ANNOTATION_END_GET.self::TAG_START."get"
                .$this->convertToPascalCase($object->getName())."(){"
                .'\n      return $this->'.$object->getName().";".self::TAG_END;
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
