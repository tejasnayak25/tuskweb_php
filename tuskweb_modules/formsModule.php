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
    public $table;
    public $inps = [];
    private $data = "";

    function add($type = "text", $name = "", $min = "", $max = "", $value = "", $placeholder = "") {
        $this->data = $this->data . "<input type='".$type."' name='".$name."' value='".$value."' placeholder='".$placeholder."' min='".$min."' max='".$max."'>";
        array_push($this->inps, $name);
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
        $this->model->insert($this->table, $values);
    }

    function form() {
        return "<form method='post'>" . $this->data . "<input name='submit' type='submit'></form>";
    }
}

?>