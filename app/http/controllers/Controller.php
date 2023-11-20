<?php

namespace   App\Http\Controllers;

use Joshyba\Joshymvc\Bin\View;
use Joshyba\Joshymvc\Bin\Conexion;

class Controller
{
    protected $request;
    private $view;
    public function __construct()
    {
        # code...
    }
    public function view($file,$variables=null)
    {
        if(empty($this->view))
        {
            $this->view = new View();
        }
        if(!Conexion::$ConexionError)
        return $this->view->render($file,$variables);
    }

    public function getRequest()
    {
        return $this->request;
    }
    public function setRequest($request)
    {
        $this->request=$request;
    }
}
?>