<?php

namespace   Joshyba\Joshymvc\Bin;

$rutaBin = "src".DIRECTORY_SEPARATOR."bin";
//$rutaControllers = "app".DIRECTORY_SEPARATOR."http".DIRECTORY_SEPARATOR."controllers".DIRECTORY_SEPARATOR;
//$rutaControllers = str_replace($rutaBin,$rutaControllers,__DIR__);
$rutaViews = "resources".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR;
$rutaViews = str_replace($rutaBin,$rutaViews,__DIR__);
define('PATH_CONTROLLERS', "../");
define('PATH_VIEWS', $rutaViews);


