<?php

namespace sys\core;

class Controller {

    protected $model;

    public function __construct($model = null) {
        $this->model = $model;
        //echo("<h3>Base Controller - OK!</h3>");
    }
}
