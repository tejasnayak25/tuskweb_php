<?php
$settings = [
    "baseDir" => "/tuskweb_php",
    "templates" => "/templates",
    "staticRoot" => "/static",
    "mediaRoot" => "/media",
    "database" => array(
                "host" => "localhost",
                "user" => "root",
                "password" => "",
                "name" => "test"
                )
];
var_export($settings, true);
?>