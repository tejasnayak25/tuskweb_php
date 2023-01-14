<?php

require_once './workspace/urls.php';
require_once './workspace/settings.php';

$request = $_SERVER['REQUEST_URI'];

$url = str_replace($settings["baseDir"], "", $request);
require_once './workspace/views.php';

$exis = 0;

for ($i=0; $i < sizeof($urlpatterns); $i++) {
    $pattern = $urlpatterns[$i];

    $getreq = explode("/", $pattern['path']);
    $urlreq = explode("/", $url);

    if (sizeof($getreq) == sizeof($urlreq)) {

        if (str_contains($pattern['path'], "[str:") || str_contains($pattern['path'], "[num:")) {
            $getpat = explode("/", $pattern['path']);
            $urlpat = explode("/", $url);

            $urlheaders = [];
            $urlvars = [];

            $nya = 0;

            for ($j = 0; $j < sizeof($getpat); $j++) {
                if (str_contains($getpat[$j], "[str:") || str_contains($getpat[$j], "[num:")) {
                    array_push($urlheaders, $getpat[$j]);
                    array_push($urlvars, $urlpat[$j]);
                } else {
                    if ($urlpat[$j] == $getpat[$j]) {
                        $nya++;
                    } else {
                        $nya = 0;
                    }
                }
            }

            if ($nya > 0) {
                $views[$pattern['view']](...$urlvars);
                $exis++;
                break;
            } else {
                $exis = 0;
            }

        } else {
            if ($url == $pattern['path']) {
                $views[$pattern['view']]();
                $exis++;
                break;
            } else {
                $exis = 0;
            }
        }

    }
}

if($exis == 0) {
    redirect("404");
}

?>