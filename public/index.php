<?php

use Joshyba\Joshymvc\Router\Route;

date_default_timezone_set('America/Mexico_City');

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require __DIR__ . DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
include_once '..'.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'web.php';

header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=7776000');
if (!isset($_SESSION)) {
    @session_start();
}
/*
if(function_exists("GetTokenCsfr")){
    echo "si";
}else{echo "no";}
*/
Route::submit();
/*
echo '<pre>';
var_dump(get_included_files());
echo '</pre>';
*/
