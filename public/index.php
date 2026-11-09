<?php

use Joshyba\Joshymvc\Router\Route;
use Dotenv\Dotenv;

date_default_timezone_set('America/Mexico_City');

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$autoload=__DIR__ . DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
if(!file_exists($autoload)){
    echo "<pre>Instale la carpeta vendor con el comando: <b>composer install</b></pre>";
    exit();
}
require_once $autoload;
$dotenv = Dotenv::createImmutable(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR);
$dotenv->load();
$dotenv->required('DOMINIO');
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);
include_once '..'.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'web.php';

/* Only API
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}
*/

header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=7776000');
if (!isset($_SESSION)) {
    @session_start();
}
Route::submit();