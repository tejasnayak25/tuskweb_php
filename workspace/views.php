<?php

require_once './tuskweb_modules/shortcuts.php';
require_once './workspace/forms.php';
require_once './workspace/models.php';
require_once './workspace/settings.php';

$views =
    array(
        "home" => function () {
            render("/home.php", array("title" => "TuskWeb"));
        },
        "404" => function () {
            render("/404.php", array("view" => "one", "title" => "404"));
        }
    );

var_export($views, true);
?>
