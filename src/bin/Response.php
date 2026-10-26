<?php

namespace   Joshyba\Joshymvc\Bin;

class Response
{
    public static function result($mensaje, $code = 200)
    {
        return http_response_code($code);
    }
    public static function toJson($data, $code = 200)
    {
        header('Content-type: application/json');
        http_response_code($code);
        return json_encode($data);
    }
}
