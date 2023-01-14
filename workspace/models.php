<?php
require_once "./tuskweb_modules/dbModule.php";

$db1 = new SQLdb();
$db1->host = "localhost";
$db1->user = "root";
$db1->password = "";
$db1->database = "test";

// $db1->connect();
// $db1->insert("users", ['tejas', 'pass', 'Hi_im_tejas', 'email@gmail.com']);
// $res = $db1->customQuery("SELECT * FROM `users`");


var_export($db1, true);

?>
