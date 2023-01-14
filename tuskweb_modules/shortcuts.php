<?php

function render($file, $array = [], $extends = "") {
    include './workspace/settings.php';

    $keys = array_keys($array);
    
    for ($i=0; $i < sizeof($keys); $i++) {
        ${$keys[$i]} = $array[$keys[$i]];
    }

    if($extends != "") {
        $doc = file_get_contents(__DIR__ . "\.." . $settings['templates'] . $file);

        // breaking content into blocks
        $content = explode("{block '", $doc);

        $p = 1;

        while ($p < sizeof($content)) {

            // blockname
            $blockname = explode("'}", $content[$p]);
            $blockname = $blockname[0];

            // echo $blockname;
         
            // data
            $data = explode("'}", $content[$p]);

            $data = explode("{end_block}", $data[1]);

            ${$blockname} = $data[0];

            $p++;
        }

        require __DIR__ . "\.." . $settings['templates'] . $extends;
    } else {
        require __DIR__ . "\.." . $settings['templates'] . $file;
    }
}

function redirect($name) {
    include './workspace/urls.php';
    include './workspace/settings.php';
    
    for ($i=0; $i < sizeof($urlpatterns); $i++) { 
        if($name == $urlpatterns[$i]['name']) {
            header("Location: " . $settings["baseDir"] . $urlpatterns[$i]['path']);
        }
    }
}

function path($url, $view, $name) {
    return array("path" => $url, "view" => $view, "name" => $name);
}

function loadStatic($url) {
    include './workspace/settings.php';

    echo $settings['baseDir'] . $settings['staticRoot'] . $url;
}

function loadMedia($url) {
    include './workspace/settings.php';

    echo $settings['baseDir'] . $settings['mediaRoot'] . $url;
}

function url($name) {
    include './workspace/urls.php';
    include './workspace/settings.php';
    
    for ($i=0; $i < sizeof($urlpatterns); $i++) { 
        if($name == $urlpatterns[$i]['name']) {
            return $settings['baseDir'] . $urlpatterns[$i]['path'];
        }
    }

    return null;
}

?>