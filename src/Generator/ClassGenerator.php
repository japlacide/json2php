<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Generator;
/**
 * Description of ClassGenarete
 *
 * @author MarcosAlexandrede
 */
class ClassGenerator extends AbstractGenerator{
    const __NAMESPACE       = '\n&#60;?php'
                            . '\n\nnamespace Entity;';
    const __ANNOTATION      = '\n/**'
                            . '\n* @author Marcos Alexandre de Oliveira'
                            . '\n*/';
    const __CLASS           = '\nclass %(className)s {'
                            . '\n\n     %(propertys)s'
                            . '\n   public function __construct() {'
                            . '\n       %(newObjects)s'
                            . '\n   }'
                            . '\n\n     %(methods)s'
                            . '\n\n}';
    const __OBJ             = '\n      $this->%(var)s = new %(class)s();'; 

                    /**
     *
     * @var PropertyGenerator
     */
    private $property;
    
    /**
     *
     * @var MethodGenerator
     */
    private $method;
    
    
    private $arrayFileClass = array();
    public function __construct(array $classArray) {
        parent::__construct();
        $this->arrayClass = $classArray;
    }
    
    public function getProperty() {
        return $this->property;
    }

    public function getMethod() {
        return $this->method;
    }
    

    public function setProperty($property) {
        if (!($property instanceof PropertyGenerator)) {
            throw new \Exception("Call to undefined function");
        }
        $this->property = &$property;
        return $this;
    }

    public function setMethod($method) {
        if (!($method instanceof MethodGenerator)) {
            throw new \Exception("Call to undefined function");
        }
        $this->method = $method;
        return $this;
    }
    
    public function montClass() {
        foreach ($this->arrayClass as $className => $objectArray) {
            $this->arrayFileClass[$className] = self::__NAMESPACE.self::__ANNOTATION
            .str_replace("%(methods)s",$this->method->getItemArrayMethod($className),    
             str_replace("%(propertys)s",$this->property->getItemArrayProperty($className),
             str_replace("%(className)s",$className,self::__CLASS)));
            $newObjects = '';
            foreach ($objectArray as $object) {
                if ($object->getIsClass()) {
                    $newObjects .= str_replace("%(class)s",
                        $this->convertToPascalCase($object->getName()),
                        str_replace("%(var)s", $object->getName(), self::__OBJ)
                    );
                }
            }
            $this->arrayFileClass[$className] = str_replace("%(newObjects)s", 
                        $newObjects, $this->arrayFileClass[$className]);
        }
        return $this;
    }
    
    public function getArrayFileClass() {
        return $this->arrayFileClass;
    }
    
    public function getItemArrayFileClass($key) {
        return $this->getIfIsSet($this->arrayFileClass, $key);
    }


}
