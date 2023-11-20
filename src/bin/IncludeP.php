<?php

namespace   Joshyba\Joshymvc\Bin;

///Incluye las cabeceras y heads
class IncludeP
{
    private static $variables;
    //$file resources\\views\\errors\\403
    public static function render($file,$variables = null,$manual=false)
    {
        $parts = array();
        if (strpos($file, "."))
        {
            $methodParts = explode(".", $file);
            $parts["carpeta"] = $methodParts[0];
            $parts["file"] = $methodParts[1];
            $file=$parts["carpeta"].DIRECTORY_SEPARATOR.$parts["file"];
        }

        if(!$manual)
        {
            $file = PATH_VIEWS.$file;
        }
        else{
            $xpath=str_replace("src\\bin","",__DIR__);
            $file = $xpath.$file;
        }
        self::$variables = $variables;   
        ob_start(); //Abrimos un buffer
        self::includeFile($file);
        $output= ob_get_contents();
        ob_end_clean(); //cerramos el buffer
        //echo "IncludeP => JOshyba => JOshyba";
        echo $output;
    }
    public static function renderReturn($file,$variables = null,$manual=false)
    {
        $parts = array();
        if (strpos($file, "."))
        {
            $methodParts = explode(".", $file);
            $parts["carpeta"] = $methodParts[0];
            $parts["file"] = $methodParts[1];
            $file=$parts["carpeta"].DIRECTORY_SEPARATOR.$parts["file"];
        }

        if(!$manual)
        {
            $file = PATH_VIEWS.$file;
        }
        else{
            $xpath=str_replace("src\\bin","",__DIR__);
            $file = $xpath.$file;
        }        
        self::$variables = $variables;
        ob_start(); //Abrimos un buffer
        self::includeFile($file);
        $output= ob_get_contents();
        ob_end_clean(); //cerramos el buffer
        return $output;
    }    

    public static function includeFile($file)
    {
        #Creamos las variables en el contexto actual
        if(isset(self::$variables) && is_array(self::$variables))
        {
            foreach(self::$variables as $key => $value)
            {
                global ${$key};
                ${$key} = $value;
            }
        }
        if(file_exists($file))
        {
            return include_once $file;
        }
        elseif(file_exists($file.".php"))
        {
            return include_once $file.".php";
        }
        elseif(file_exists($file.".html"))
        {
            return include_once $file.".html";
        }
        else
        {
            echo $file;
            echo '<h2>No existe el archivo</h2>';
        }
    }
}
?>