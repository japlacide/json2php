<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Generator;

use Generator\Json\IJson,
    Generator\Json\JsonConverte;

/**
 * Description of AbstractGenerate
 *
 * @author MarcosAlexandrede
 */
class AbstractGenerator implements IJson {

    /**
     *
     * @var \Generator\Json\JsonConverte
     */
    protected $json = null;
    protected $arrayClass;

    public function __construct() {
        $this->json = new JsonConverte();
    }

    public function getJson() {
        return $this->json->getJson();
    }

    public function hasJson() {
        return $this->json->hasJson();
    }
    
    public function hasArrayClass() {
        return isset($this->arrayClass);
    }

    public function prepareJSONString(string $jsonString) {
        return $this->json->prepareJSONString($jsonString);
    }

    /**
     * @return \Genarate\Json\JsonConverte Description
     */
    public function getJsonConverte() {
        return $this->json;
    }

    public function convertToPascalCase(string $name) {
        $name[0] = strtoupper($name[0]);
        $func = create_function('$c', 'return strtoupper($c[1]);');
        return preg_replace_callback('/_([a-zA-Z])/', $func, $name);
    }

    public function isClass($param) {
        return is_object($param);
    }
    
    public function getIfIsSet(array $param,$key) {
        if (isset($param[$key])) {
            return $param[$key];
        }else{
            return NULL;
        }
    }

}
