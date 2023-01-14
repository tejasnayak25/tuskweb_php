<?php
class SQLdb{
    public $host;
    public $user;
    public $password;
    public $database;
    private $mysql;

    function connect() {
        $this->mysql = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if($this->mysql) {
            // echo "connected";
        }
    }

    function insert($table, $values) {
        $data = join("','", $values);
        $checkQuery = mysqli_query($this->mysql, "SELECT * FROM `".$table."`");

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
                $sql = mysqli_query($this->mysql, "INSERT INTO `" . $table . "` VALUES ('" . $data . "')") or die("something went wrong!");
            }
        } else {
            $sql = mysqli_query($this->mysql, "INSERT INTO `" . $table . "` VALUES ('" . $data . "')") or die("something went wrong!");
        }
        
        
    }

    function update($table, $values, $where) {
        $values = join("','", $values);
        $where = join(",", $where);

        $findRow = mysqli_query($this->mysql, "SELECT * FROM `".$table."`");

        if(mysqli_num_rows($findRow)) {
            while($row = $findRow->fetch_assoc()) {
                $data = join(",", $row);

                if($where == $data) {
                    echo 'Hi';
                }
            }
        } else {
            return NULL;
        }
    }

    function customQuery($query) {
        $results = mysqli_query($this->mysql, $query);
        return $results;
    }
}
?>