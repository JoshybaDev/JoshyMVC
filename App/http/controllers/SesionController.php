<?php

namespace   App\Http\Controllers;

use Joshyba\Joshymvc\Router\Request;

class SesionController extends Controller
{
    public function index(Request $request)
    {
        echo "Todo Ok, si señor";
        echo "<hr>";
        echo "Var dump de un array<br>";
        $Unarray =["id"=>1,"nombre"=>"Juan"];
        showVarDum($Unarray);
    }
}

