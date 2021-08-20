<?php

namespace sys\core;

use \sys\lib\Field as Field;

class Form
{

    public $name;
    public $className;
    public $methodName;
    public $actionPath;
    public $enctype;
    public $fields;

    public function generate()
    {
        echo('<form');
        echo(' id="' . $this->name . '"');
        echo(' class="' . $this->className . '"');
        echo(' method="' . $this->methodName . '"');
        echo(' action="' . $this->actionPath . '"');
        //
        if ($this->enctype !== '') {
            echo(' enctype="' . $this->enctype . '"');
        }
        //*
        if ($this->name !== 'entryform') {
            echo(' onsubmit="return false"');
        }
        echo('>');
        //
        if (is_array($this->fields) && count($this->fields) > 0) {
            foreach ($this->fields as $field) {
                if ($field instanceof Field) {
                    echo('<div class="form-group">');
                    //*
                    if ($field->name !== 'stand') {
                        echo('<label for="' . $field->name . '">');
                        echo(ucfirst($field->name) . ':');
                        echo('</label>');
                        $field->generate();
                    } else {
                        echo('<p> style="text-align:center; margin:30px 0 -10px 0"');
                        echo('<input type="checkbox" id="stand" name="stand" value="yes">');
                        echo('&nbsp;');
                        echo('<label for="stand">Оставаться в системе</label>');
                        echo('</p>');
                    }
                    //
                    echo('<div class="error"');
                    echo(' id="' . $field->name . '-error">');
                    echo('');
                    echo('</div>');
                    //
                    echo('</div>');
                }
            }
        }
        //
        echo('<div class="btn-group">');
        echo("<input type='submit' id='submit' name='submit' value='Отправить' class='btn-sm btn-success my-btn' />");
        echo("<input type='reset' id='reset' name='reset' value='Очистить' class='btn-sm btn-danger my-btn' />");
        echo("</div>");
        //
        echo('</form>');
    }

    public function fill()
    {
        if (is_array($this->fields) && count($this->fields) > 0) {
            foreach ($this->fields as $field) {
                if (isset($_POST[$field->name])) {
                    $field->fieldValue = $_POST[$field->name];
                }
            }
        }
    }
}