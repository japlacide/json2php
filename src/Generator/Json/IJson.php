<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Generator\Json;

/**
 *
 * @author MarcosAlexandrede
 */
interface IJson {
    //put your code here
    /**
     * @param string $jsonString
     * @return object JSON
     */
    public function prepareJSONString(string $jsonString);
   
    /**
     * @return boolean 
     */
    public function hasJson();
    
    /**
     * @return object
     */
    public function getJson();
    
}
