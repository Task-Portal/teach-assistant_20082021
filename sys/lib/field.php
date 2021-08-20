<?php

namespace sys\lib;

class Field {

    public $name;
    public $tagName;
    public $typeName;
    public $className;
    public $fieldValue;

    public function __construct($name, $tagName, $typeName, $className, $fieldValue = '') {
        $this->name = $name;
        $this->tagName = $tagName;
        $this->typeName = $typeName;
        $this->className = $className;
    }

    public function generate() {
        //<input type="text" name="login" id="login" class="form-item" placeholder="..." required/>
        echo('<');
        echo($this->tagName);
        echo(' type="'.$this->typeName.'"');
        echo(' name="'.$this->name.'"');
        echo(' id="'.$this->name.'"');
        echo(' class="'.$this->className.'"');
        echo(' placeholder="Type '.$this->name.' here ..."');
        echo(' required');
        echo('/>');
    }
}