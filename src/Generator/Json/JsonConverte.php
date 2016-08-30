<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Generator\Json;
/**
 * Description of JsonConverte
 *
 * @author MarcosAlexandrede
 */
class JsonConverte extends AbstractJson{
    public function __construct($json = null) {
        parent::__construct($json);
    }
    
    /**
     * 
     * @param string $param
     * @return object
     */
    public function stringToJsonObject(string $param) {
        return json_decode($param);
    }
    /**
     * 
     * @param object $param
     * @return string
     */
    public function jsonObjectToString(object $param) {
        return json_encode($param, JSON_UNESCAPED_SLASHES);
    }
    
}
