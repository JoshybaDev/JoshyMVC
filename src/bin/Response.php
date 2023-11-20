<?php

namespace   Joshyba\Joshymvc\Bin;

class Response
{
    function result($mensaje,$code=200){
        return http_response_code($code);
    }
}