<?php

require_once './tuskweb_modules/shortcuts.php';

$urlpatterns = array(
    path("/", "home", "Home"),
    path("/404", "404", "404")
);

var_export($urlpatterns, true);
?>