<?php

namespace app\forms;

use \sys\core\Form as Form;
use \sys\lib\Field as Field;

class Entryform extends Form {
    public function __construct(){
        $this->name = 'entryform';
        $this->className='entry-form';
        $this->methodName='post';
        $this->actionPath='#';
        $this->enctype='';
        $this->fields=[
            new Field('login','input','text','form-control'),
            new Field('pass','input','password','form-control'),
            new Field('stand','input','checkbox','form-control'),
        ];
    }
}