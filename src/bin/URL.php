<?php

namespace   Joshyba\Joshymvc\Bin;


class URL
{
    public static function base()
    {
        # code...
        $base_dir = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER["SCRIPT_NAME"]);
        $baseURL = (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://{$_SERVER["HTTP_HOST"]}{$base_dir}";
        return trim($baseURL,"/");
    }
    public static function to($url)
    {
        # code...
        $url = trim($url,"/");
        return url::base()."/{$url}";
    }
    //Obtiene la url completa
    public static function getFull()
    {
        # code...
        return (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://{$_SERVER["HTTP_HOST"]}{$_SERVER["REQUEST_URI"]}";
    }
}
?>