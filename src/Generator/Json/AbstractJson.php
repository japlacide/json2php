<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Generator\Json;
/**
 * Description of AbstractJson
 *
 * @author MarcosAlexandrede
 */
abstract class AbstractJson implements IJson{
    protected $objectJson = null;
    public function __construct($json=null) {
        if ($json) {
            $this->prepareJSONString($json);
        }
        
    }
    public function getJson() {
        if ($this->hasJson()) {
            return $this->objectJson;
        }else{
            throw new \Exception("Objeto JSON não Localizado!");
        }
    }

    public function hasJson() {
        return isset($this->objectJson);
    }

    public function isList($param) {
        return is_array($param);
    }

    public function prepareJSONString(string $jsonString) {
        try{
            $this->objectJson = json_decode($jsonString);
            if ($this->isList($this->objectJson)) {
                $this->objectJson = $this->objectJson[0];
            }
        }  catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    
}
