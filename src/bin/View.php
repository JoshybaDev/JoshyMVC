<?php

namespace   Joshyba\Joshymvc\Bin;

use Joshyba\Joshymvc\Bin\IncludeP;

class View
{
    private $variables;
    public function __construct()
    {
        # code...
    }
    public function render($file,$variables = null)
    {
        //Vamos a separar por carpetas
        $ruta = "";
        if (strpos($file, "."))
        {
            $methodParts = explode(".", $file);
            $posarchivo = count($methodParts)-1;
            foreach ($methodParts as $pos => $value) {
                if($pos != $posarchivo){
                    $ruta.=$value.DIRECTORY_SEPARATOR;
                }else{
                    $ruta.=$value;
                }
            }
            $file=$ruta;
        }
        $this->variables = $variables;
        $file = PATH_VIEWS.$file;
        //echo "View  => render =>[$file]<";
        ob_start(); //Abrimos un buffer
        $this->includeFile($file);
        $output = ob_get_contents();
        //ob_end_flush();
        ob_end_clean(); //cerramos el buffer
        return $output;
    }

    public function includeFile($file)
    {
        
        #Creamos las variables en el contexto actual
        if(isset($this->variables) && is_array($this->variables))
        {
            foreach($this->variables as $key => $value)
            {
                global ${$key};
                ${$key} = $value;
            }
        }
        if(file_exists($file))
        {
            return include_once  $file;
        }
        elseif(file_exists($file.".php"))
        {
            return include_once  $file.".php";
        }
        elseif(file_exists($file.".html"))
        {
            return include_once  $file.".html";
        }
        else
        {
            echo $file;
            echo '<h2>No existe el archivo</h2>';
        }
    }
}
?>