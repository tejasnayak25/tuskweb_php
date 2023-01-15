<?php
require_once "./tuskweb_modules/dbModule.php";

$db1 = new SQLdb();
$db1->model = "users";

// $db1->connect();

var_export($db1, true);

?>
