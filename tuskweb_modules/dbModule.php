<?php

include './workspace/settings.php';
class SQLdb{
    public $model;
    private $mysql;

    function connect() {
        $host = $GLOBALS['settings']['database']['host'];
        $user = $GLOBALS['settings']['database']['user'];
        $password = $GLOBALS['settings']['database']['password'];
        $database = $GLOBALS['settings']['database']['name'];

        $this->mysql = mysqli_connect($host, $user, $password, $database);
        if(!$this->mysql) {
            echo "error";
        }
    }

    function insert($values) {
        $data = join("','", $values);
        $checkQuery = mysqli_query($this->mysql, "SELECT * FROM `".$this->model."`");

        if (mysqli_num_rows($checkQuery)) {
            $users = [];
            while ($row = $checkQuery->fetch_assoc()) {
                array_push($users, join(",", $row));
            }

            $data2 = join(",", $values);

            $exis = 0;

            for ($i = 0; $i < sizeof($users); $i++) {
                if ($data2 != $users[$i]) {
                    $exis++;
                } else {
                    $exis = 0;
                }
            }

            if ($exis > 0) {
                $sql = mysqli_query($this->mysql, "INSERT INTO `" . $this->model . "` VALUES ('" . $data . "')") or die("something went wrong!");
            }
        } else {
            $sql = mysqli_query($this->mysql, "INSERT INTO `" . $this->model . "` VALUES ('" . $data . "')") or die("something went wrong!");
        }
        
        
    }

    function update($values, $where) {
        $keys = array_keys($where);
        $where = array_values($where);
        $head = $this->headers();
        $headers = [];

        for ($i = 0; $i < sizeof($head); $i++) {
            array_push($headers, $head[$i]['Field']);
        }

        $arr = [];
        $val = [];

        for ($i = 0; $i < sizeof($where); $i++) {
            array_push($arr, "`" . $keys[$i] . "`='". $where[$i] . "'");
        }
        for ($i = 0; $i < sizeof($headers); $i++) {
            array_push($val, "`" . $headers[$i] . "`='" . $values[$i] . "'");
        }

        $arr = join(" && ", $arr);
        $val = join(",", $val);

        $findRow = mysqli_query($this->mysql, "UPDATE `".$this->model."` SET ". $val. " WHERE ". $arr);

        if(!$findRow) {
            echo "An error occurred";
        }
    }

    function delete($where) {
        $keys = array_keys($where);
        $where = array_values($where);

        $arr = [];

        for ($i = 0; $i < sizeof($where); $i++) {
            array_push($arr, "`" . $keys[$i] . "`='". $where[$i] . "'");
        }

        $arr = join(" && ", $arr);

        $findRow = mysqli_query($this->mysql, "DELETE FROM `".$this->model."` WHERE ". $arr);

        if(!$findRow) {
            echo "An error occurred";
        }
    }

    function select($where) {
        $keys = array_keys($where);
        $where = array_values($where);

        $arr = [];

        for ($i = 0; $i < sizeof($where); $i++) {
            array_push($arr, "`" . $keys[$i] . "`='". $where[$i] . "'");
        }

        $arr = join(" && ", $arr);

        $results = mysqli_query($this->mysql, "SELECT * FROM `".$this->model."` WHERE ". $arr);

        $final = [];

        if (mysqli_num_rows($results)) {
            while ($row = $results->fetch_assoc()) {
                array_push($final, $row);
            }
        }
        if(!$results) {
            echo "An error occurred";
        }

        return $final;
    }

    function customQuery($query) {
        $results = mysqli_query($this->mysql, $query);
        return $results;
    }

    function headers() {
        $results = mysqli_query($this->mysql, "DESC `".$this->model."`");

        $headerList = [];
        if (mysqli_num_rows($results)) {
            while ($row = $results->fetch_assoc()) {
                array_push($headerList, $row);
            }
        }

        return $headerList;
    }

    function fields() {
        $head = $this->headers();

        $headers = [];

        for ($i = 0; $i < sizeof($head); $i++) {
            array_push($headers, array("field"=>$head[$i]['Field'], "type"=>$head[$i]['Type']));
        }

        return $headers;
    }
}
?>