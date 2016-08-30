<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Generator;

/**
 * Description of FragmentedObject
 *
 * @author MarcosAlexandrede
 */
class FragmentedObject {
    //put your code here
    private $name;
    private $type;
    private $isClass;
    function getName() {
        return $this->name;
    }

    function getType() {
        return $this->type;
    }

    function getIsClass() {
        return $this->isClass;
    }

    function setName($name) {
        $this->name = $name;
        return $this;
    }

    function setType($type) {
        $this->type = $type;
        return $this;
    }

    function setIsClass($isClass) {
        $this->isClass = $isClass;
        return $this;
    }


}
