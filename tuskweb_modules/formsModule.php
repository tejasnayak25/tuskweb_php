<?php

class Forms {
    public $name;
    public $inps = [];
    private $data = "";

    function add($type = "text", $name = "", $min = "", $max = "", $value = "", $placeholder = "") {
        $this->data = $this->data . "<input type='".$type."' name='".$name."' value='".$value."' placeholder='".$placeholder."' min='".$min."' max='".$max."'>";
        array_push($this->inps, $name);
    }

    function output() {
        $data = [];
        for($i=0;$i<sizeof($this->inps);$i++) {
            $data[$this->inps[$i]] = $_POST[$this->inps[$i]];
        }

        return $data;
    }

    function form() {
        return "<form method='post'>" . $this->data . "<input name='submit' type='submit'></form>";
    }
}


class ModelForms {
    public $name;
    public $model;
    public $inps = [];
    private $data = "";

    function init($initial = null) {

        $fields = ($this->model)->fields();

        for ($i = 0; $i < sizeof($fields); $i++) {
            $type = $fields[$i]['type'];
            $field = $fields[$i]['field'];

            if($type == "date") {
                $type = "date";
            } else if($type == "int" || $type == "float" || $type == "decimal" || $type == "smallint" || $type == "tinyint" || $type == "longint") {
                $type = "number";
            } else {
                $type = "text";
            }

            if($initial != null) {
                $this->data = $this->data . "<input type='".$type."' name='".$field."' value='".$initial[$field]."'>";
            } else {
                $this->data = $this->data . "<input type='".$type."' name='".$field."'>";
            }
            
            array_push($this->inps, $field);
        }
    }

    function save() {
        $values = [];
        $inps = $this->inps;
        function getValues($inps, &$values= []) {
            for($i=0; $i<sizeof($inps); $i++) {
                $data = $_POST[$inps[$i]];
                array_push($values, $data);
            }
        }
        getValues($inps, $values);
        $this->model->insert($values);
    }

    function delete() {
        $values = [];
        $inps = $this->inps;
        function getValues2($inps, &$values= []) {
            for($i=0; $i<sizeof($inps); $i++) {
                $data = $_POST[$inps[$i]];
                array_push($values, $data);
            }
        }
        getValues2($inps, $values);
        $keys = $this->model->fields();
        $arr = [];

        for ($i = 0; $i < sizeof($keys); $i++) {
            $arr[$keys[$i]['field']] = $values[$i];
        }

        $this->model->delete($arr);
    }

    function form() {
        return "<form method='post'>" . $this->data . "<input name='submit' type='submit'></form>";
    }
}

?>