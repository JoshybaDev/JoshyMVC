<?php

namespace   Joshyba\Joshymvc\Router;

use Joshyba\Joshymvc\Bin\Respuesta;

class Uri {

    var $uri;
    var $method;
    var $function;
    var $matches;
    protected $request;
    protected $response;

    public function __construct($uri, $method, $function) {
        $this->uri = $uri;
        $this->method = $method;
        $this->function = $function;
    }
    public function call() {
        try {
            $this->request = $_REQUEST;
            if (is_string($this->function)) {
                $this->functionFromController();
            } else {
                $this->execFunction();
            }
            $this->printResponse();
        } catch (\Exception $ex) {
            echo "ERROR: " . $ex->getMessage();
        }
    }

    private function functionFromController() {
        $parts = $this->getParts();
        $class = $parts["class"];
        $classImport = str_replace('\\',DIRECTORY_SEPARATOR,$class);
        $method = $parts["method"];
        //echo "Uri => functionFromController =>".$classImport."<br>";
        //Importamos el controlador...
        if (!$this->importController($classImport)) {
            return;
        }
        //Preparar la ejeución...
        $this->parseRequest();
        //echo "<br>Uri => ---------------=>".$class."<br>";
        $classInstance = new $class();
        $classInstance->setRequest($this->request);
        //Lanzamos el método...
        $launch = array($classInstance, $method);
        if (is_callable($launch)) {
            $this->response = call_user_func_array($launch, $this->matches);
        } else {
            throw new \Exception("El método $class.$method no existe.", -1);
        }
    }

    public function importController($class) {
        $file = PATH_CONTROLLERS . $class . ".php";
        
        if (!file_exists($file)) {
            throw new \Exception("El controlador ($file) no existe.");
            return false;
        }
        //echo "Uri => importController ========>".$file;
        require_once $file;
        return true;
    }

    private function parseRequest() {
        $this->request = new Request($this->request);
        $this->matches[] = $this->request;
    }

    private function execFunction() {
        $this->parseRequest();
        $this->response = call_user_func_array($this->function, $this->matches);
    }


    private function printResponse() {
        if (is_string($this->response)) {
            echo $this->response;
        } else if (is_object($this->response) || is_array($this->response)) {
            $res = new Respuesta();
            echo $res->json($this->response);
        }
    }


    public function match($url) {
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->uri);
        $regex = "#^$path$#i";
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }
        if ($this->method != $_SERVER['REQUEST_METHOD'] && $this->method != "ANY") {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }
    




    private function getParts() {
        $parts = array();
        if (strpos($this->function, "@")) {
            $methodParts = explode("@", $this->function);
            $parts["class"] = $methodParts[0];
            $parts["method"] = $methodParts[1];
        } else {
            $parts["class"] = $this->function;
            $parts["method"] = ($this->uri == "/") ? "index" : $this->formatCamelCase($this->uri);
        }
        return $parts;
    }

    private function formatCamelCase($string) {
        $parts = preg_split("[-|_]", ($string)); //listar_usuarios. = ["listas", "Usuarios"]
        $finalString = "";
        $i = 0;
        foreach ($parts as $parts) {
            $finalString .= ($i = 0) ? ($parts) : ucfirst($parts);
            $i++;
        }
        return $finalString;
    }











}
