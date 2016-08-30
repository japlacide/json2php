<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Generator;

/**
 * Description of JsonToClass
 *
 * @author MarcosAlexandrede
 */
class JsonToClass extends AbstractGenerator {

    /**
     *
     * @var ClassGenerator
     */
    protected $class = null;

    /**
     *
     * @var \PropertyGenerator
     */
    protected $property = null;

    /**
     *
     * @var MethodGenerator
     */
    protected $method = null;

    public function __construct($param = NULL) {
        parent::__construct();

        $this->prepareJSONString((string) $param);
    }

    public function startConvert($nameRoot = 'ClassRoot') {
        if ($this->hasJson()) {
            $this->eachObjectJson($this->getJson(), $nameRoot);
            $this->generateClass();
        } else {
            throw new Exception("Error! Json is not empty!");
        }
    }

    private function eachObjectJson($object, $className) {
        $listFagmentedObject = new \ArrayObject();
        foreach ($object as $property => $value) {
            $fragment = new FragmentedObject();
            $fragment
                    ->setName($property)
                    ->setType($this->getType($value))
                    ->setIsClass($this->isClass($value));
            $listFagmentedObject->append($fragment);
            if ($fragment->getIsClass()) {
                $this->eachObjectJson($value, $property);
            }
            if ($fragment->getType() == "array") {
                $this->redeemObjectOfArray($value, $property);
            }
        }
        $this->arrayClass[$this->convertToPascalCase($className)] = $listFagmentedObject;
    }

    protected function getType($param) {
        $type = gettype($param);
        if ($type == "unknown type") {
            return NULL;
        }
        return $type;
    }

    private function redeemObjectOfArray(array $param, $className) {
        if (isset($param)) {
            $this->eachObjectJson($param[0], $className);
        }
    }

    private function generateClass() {
        $this->class = new ClassGenerator($this->arrayClass);
        $this->class
                ->setMethod($this->generateMethod())
                ->setProperty($this->generateProperty())
                ->montClass();
        
    }

    private function generateProperty() {
        $this->property = new PropertyGenerator($this->arrayClass);
        return $this->property;
    }

    /**
     * 
     * @return \MethodGenerator
     */
    private function generateMethod() {
        $this->method = new MethodGenerator($this->arrayClass);
        return $this->method;
    }
    
    /**
     * 
     * @return ClassGenerator
     */
    public function getClass() {
        return $this->class;
    }

}
