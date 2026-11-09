<?php

namespace   Joshyba\Joshymvc\Router;

use Joshyba\Joshymvc\Bin\CSFR;
use Joshyba\Joshymvc\Bin\Errores;

class Route
{

    public function __construct()
    {
    }
    private static $uris = array();
    public static $xRuta = "";

    public static function add($method, $uri, $function = null)
    {
        Route::$uris[] = new Uri(self::parseUri($uri), $method, $function);
        return;
    }

    public static function get($uri, $function = null)
    {
        return Route::add("GET", $uri, $function);
    }

    public static function post($uri, $function = null)
    {
        return Route::add("POST", $uri, $function);
    }

    public static function put($uri, $function = null)
    {
        return Route::add("PUT", $uri, $function);
    }

    public static function delete($uri, $function = null)
    {
        return Route::add("DELETE", $uri, $function);
    }

    public static function any($uri, $function = null)
    {
        return Route::add("ANY", $uri, $function);
    }

    private static function parseUri($uri)
    {
        $uri = trim($uri, '/');
        $uri = (strlen($uri) > 0) ? $uri : '/';
        return $uri;
    }

    public static function submit()
    {
        //$method = $_SERVER['REQUEST_METHOD'];
        $uri = isset($_GET['uri']) ? $_GET['uri'] : '';
        $uri = self::parseUri($uri);
        //echo var_dump(Route::$uris,$uri );
        if (!CSFR::SeEnvioToken()) {
            //Verifica si la uri que está pidiendo el usuario se encuentra registrada...
            foreach (Route::$uris as $key => $recordUri) {
                Route::$xRuta = $uri;
                if ($recordUri->match($uri)) {
                    return $recordUri->call();
                }
            }
            return Errores::Error(404); 
        }
    }
}
