<?php

use Joshyba\Joshymvc\Router\Route;


error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require __DIR__ . '/../vendor/autoload.php';
include_once '../routes/web.php';

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
