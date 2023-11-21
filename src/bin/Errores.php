<?php

namespace   Joshyba\Joshymvc\Bin;

use Joshyba\Joshymvc\Bin\IncludeP;
use Joshyba\Joshymvc\Bin\Response;

class Errores
{
    public function __construct(){

    }

    public static function error($error)
	{
		//$response = new Response();
		header("Content-Type: text/html");
		//$response->result('',$error);
		switch($error)
		{
			case 403:
				return IncludeP::render('errors.403',null);  	
			break;		
			case 404:
				return IncludeP::render('errors.404',null);  
			break;
			case 409:
				return IncludeP::render('errors.409',null);  	
			break;
		}
		return false;
	}
}