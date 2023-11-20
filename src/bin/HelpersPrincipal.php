<?php
//No colocar namespaces para archivos helpers
// de funciones globales ya que requerirá la definición de la función
//Ejemplo:
//use function Joshyba\Joshymvc\Bin\GetTokenCsfrHTML;
//en donde se vaya a implemental
//namespace   Joshyba\Joshymvc\Bin;  ///

use Joshyba\Joshymvc\Bin\URL;
use Joshyba\Joshymvc\Bin\CSFR;
use Joshyba\Joshymvc\Bin\IncludeP;
use Joshyba\Joshymvc\Router\Route;

function PruebaFuncion(){
    echo "strong>PruebaFuncion al 100%</strong>";
}
function ViewRender($file,$variables = null,$manual=false){
    return IncludeP::render($file,$variables,$manual);
}
function VersionSistema()
{
    return date('dmy');
}
function GetTokenCsfr(){
    return CSFR::Token_csrf_token();
}
function GetTokenCsfrHTML(){
    CSFR::Token_RetornaHTML_CsFr();
}
function UrlTo($url){
    return URL::to($url);
}
function UrlBase(){
    return URL::base();
}
function Redirect($ruta)
{
    header('Location:'.$ruta);
    exit;
}
function IsRoute($ruta)
{
    return Route::$xRuta==$ruta;
}
function EsDebug()
{
    return true;
}
function getIp()
{
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key)
    {
        if (array_key_exists($key, $_SERVER) === true)
        {
            foreach (explode(',', $_SERVER[$key]) as $ip)
            {
                $ip = trim($ip); // just to be safe
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false)
                {
                    return $ip;
                }
            }
        }
    }
}

function detect()
{
	$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
    $movil = array("ANDROID", "WEBOS", "IPHONE", "IPOD", "IPAD", "BLACKBERRY");
	$os=array("WIN","MAC","LINUX");

	# definimos unos valores por defecto para el navegador y el sistema operativo
	$info['browser'] = "OTHER";
    $info['dispositivo'] = "PC";
    $info['os'] = "OTHER";
    $info['version'] = "0";
    $info['esmovil'] = "No";

	# buscamos el navegador con su sistema operativo
	foreach($browser as $parent)
	{
		$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
		$f = $s + strlen($parent);
		$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
		$version = preg_replace('/[^0-9,.]/','',$version);
		if ($s)
		{
			$info['browser'] = $parent;
			$info['version'] = $version;
		}
        else{
            $info['browser'] = isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'CURL';
        }
	}
    # obtenemos el DISPOSITIVO
    foreach ($movil as $val) {
        if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $val) !== false) {
            $info['dispositivo'] = $val;
            $info['esmovil'] = 'Si';
        }
    }
	# obtenemos el sistema operativo
	foreach($os as $val)
	{
		if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
			$info['os'] = $val;
	}
	# devolvemos el array de valores
	return $info;
}

function loadXmlStringAsArray($xmlString)
{
    $array=array();
    try {
        $array = (array) simplexml_load_string($xmlString);
        if(!$array){
           $array = (array) json_decode($xmlString, true);
        }
        else{
             $array = (array)json_decode(json_encode($array), true);
        }
    } catch (\Throwable $th) {

        /*$xml = explode("\n", $xmlString);
        $errors = libxml_get_errors();
        foreach ($errors as $error)
        {
            echo $this->display_xml_error($error, $xml);
        }

        libxml_clear_errors();
        throw $th;
        */
    }
    return $array;
}

function display_xml_error($error, $xml)
{
    $return  = $xml[$error->line - 1] . "\n";
    $return .= str_repeat('-', $error->column) . "^\n";

    switch ($error->level) {
        case LIBXML_ERR_WARNING:
            $return .= "Warning $error->code: ";
            break;
        case LIBXML_ERR_ERROR:
            $return .= "Error $error->code: ";
            break;
        case LIBXML_ERR_FATAL:
            $return .= "Fatal Error $error->code: ";
            break;
    }

    $return .= trim($error->message) .
            "\n  Line: $error->line" .
            "\n  Column: $error->column";

    if ($error->file) {
        $return .= "\n  File: $error->file";
    }

    return "$return\n\n--------------------------------------------\n\n";
}

function objectToArray($d)
{
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    } else {
        // Return array
        return $d;
    }
}

function stdToArray($obj){
    $reaged = (array)$obj;
    foreach($reaged as $key => &$field){
        if(is_object($field))
            $field = stdToArray($field);
    }
    return $reaged;
}
function EliminarTodosDeUndirectorio($xRuta)
{
    $files = glob($xRuta.'/*'); //'my_folder/*' obtenemos todos los nombres de los ficheros
    foreach($files as $file)
    {
        if(is_file($file))
        unlink($file); //elimino el fichero
    }
}
function EliminarTodosDeUndirectorioPorExtension($xRuta,$ext)
{
    $files = glob($xRuta.'/*.'.$ext); //'my_folder/*' obtenemos todos los nombres de los ficheros
    foreach($files as $file)
    {
        if(is_file($file) && $file!='.gitignore')
        unlink($file); //elimino el fichero
    }
}
function EliminarTodosDeUndirectorioAntiguos($xRuta,$ext)
{
    $files = glob($xRuta.'/*'); //'my_folder/*' obtenemos todos los nombres de los ficheros
    foreach($files as $file)
    {
        $lastModifiedTime = filemtime($file);
        $currentTime = time();
        $timeDiff = abs($currentTime - $lastModifiedTime)/(60*60); //en horas
        if(is_file($file) && $timeDiff > 10)
        unlink($file); //elimino el fichero
    }
}
function ArchivosDeUnDirectorio($xRuta)
{
    $files = glob($xRuta.'/*'); //'my_folder/*' obtenemos todos los nombres de los ficheros
    $ArchivosQueSiSon=[];
    foreach($files as $file)
    {
        if(is_file($file))
        array_push($ArchivosQueSiSon);
    }    
    return $ArchivosQueSiSon;
}
function ValidarJSON($json, $validar, $flag_validar_data)
{
    $arrayFallidos=[];
    $fila=0;
    $flag = true;
    if ($json == null) {
        $error = array(
            'success' => false,
            'codigo' => 'JSx001',
            'mensaje' => 'Sintaxis de JSON incorrecto.'
        );
        return json_encode($error);
    } else {
        if ($flag_validar_data) {
            for ($i = 0; $i < count($validar); $i++) 
            {
                if (isset($json[$validar[$i]])) 
                {
                    if ($json[$validar[$i]] == '') 
                    {
                        $flag = false;
                        $arrayFallidos[$fila]=$validar[$i];
                    }
                } 
                else 
                {
                    $flag = false;
                    $arrayFallidos[$fila]=$validar[$i];
                }
                $fila++;
            }
            if ($flag) {
                $error = array(
                    'success' => $flag,
                    'codigo' => 'JSx001',
                    'mensaje' => 'Sintaxis de JSON correcto.'
                );
                return json_encode($error);
            } else {
                $error = array(
                    'success' => $flag,
                    'codigo' => 'Ux001',
                    'mensaje' => 'Faltan datos para procesar la peticion.',
                    'campos posibles' => $arrayFallidos,
                );
                return json_encode($error);
            }
        }
    }
}

function ValidarJSONData($json, $campos)
{
    $flag_field = true;
    $error = array();
    if ($json == null) {
        $error = array(
            'success' => false,
            'codigo' => 'JSx001',
            'mensaje' => 'Sintaxis de JSON incorrecto.'
        );
        return json_encode($error);
    } else {
        foreach ($campos as $r) {
            if ($flag_field) {
                if (isset($json[$r])) {
                    if ($json[$r] == '') {
                        $error[] = $r;
                        $flag_field = false;
                    }
                } else {
                    $error[] = $r;
                    $flag_field = false;
                }
            }
        }
    }

    $response = json_encode(array(
        "success" => $flag_field,
        "mensaje" => "Faltan datos para procesar la petición",
        "error" => $error
    ));
    return $response;
}



function DATEx()
{
    return date('Y-m-d');
}

function DATETIME()
{
    return date('Y-m-d G:i:s');
}

function sanitizeArray($array, $level = 'high')
{

    $temp = array();
    foreach ($array as $key => $value) {
        $temp[$key] = sanitize($value, $level);
    }
    return $temp;
}

function sanitize($value, $level = 'high')
{
    if (!is_array($value)) {
        switch ($level) {
            case "low":
                $value = trim($value);
                break;
            case "medium":
                $value = trim(strip_tags($value));
                break;
            case "high":

                $value = escapeString(trim(htmlentities(strip_tags($value))));
                break;
        }
    }
    return $value;
}

function escapeString($string)
{
    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\", "\\0", "\\n", "\\r", "'", '\"', "\\Z");
    return str_replace($search, $replace, $string);
}
function CrearArchivo($data, $tipo='log')
{
    date_default_timezone_set('America/Mexico_City');
    $rutaBase = "log".DIRECTORY_SEPARATOR;
    $rutaLog = "src".DIRECTORY_SEPARATOR."bin";
    $rutaLog = str_replace($rutaLog,$rutaBase,__DIR__);
    $nameFile = "";
    if ($tipo == 'abono') {
        $nameFile = uniqid() . uniqid() . uniqid() . "-" . date('d') . "_" . date('m') . "_" . date('y') . "_" . date('H') . "_" . date('i') . "_" . date('s') . "_" . "_sendabono.txt";
    }else if ($tipo == 'estado') {
        $nameFile = uniqid() . uniqid() . uniqid() . "-" . date('d') . "_" . date('m') . "_" . date('y') . "_" . date('H') . "_" . date('i') . "_" . date('s') . "_" . "_cambioestado.txt";
    }
    else
    {
        $nameFile = "log_".uniqid() . uniqid() . uniqid() . "-" . date('d') . "_" . date('m') . "_" . date('y') . "_" . date('H') . "_" . date('i') . "_" . date('s') . "_" . "_".$tipo.".txt";
    }

    $file = $rutaLog . $nameFile;
    $myfile = fopen($file, "w") or die("Unable to open file!");
    if(is_array($data))
    {
        foreach ($data as $key => $value)
        {
            if(is_array($data))
            {
                foreach ($value as $key => $value2)
                {
                    fwrite($myfile, $key . " : " . $value2 . "\n");
                }
            }
            else
            {
                fwrite($myfile, $data. "\n");
            }
        }
    }
    else
    {
        fwrite($myfile, $data. "\n");
    }
    //fwrite($myfile, __DIR__);
    //fwrite($myfile, $xRuta);
    fclose($myfile);
}
function fetchUrl($uri,$parametrosArray,$method='POST',$arhivo=false) 
{
    #Funcion Curl
    $curl = curl_init();
    $archivo_=array(
        "Content-Type: multipart/form-data;", // change Content-Type
    );
    if($arhivo==false)$archivo_=null;
    curl_setopt_array($curl, array(
        CURLOPT_URL => $uri,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYPEER => false, /*ignora la validacion de ssl*/
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $archivo_,
        /*CURLOPT_POSTFIELDS => array(
            'rutaimg' => curl_file_create($pathoffile, $_FILES['rutaimg']['type'], $nameImagen), 'usuario_id' => $usuario_id, 'token' => '47c74009bedff2c96eb4c273f7635d19186cdad2'
        ),*/
        CURLOPT_POSTFIELDS => $parametrosArray,        
    ));
    $response = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if($response === false)
    {
        $response.=curl_error($curl);
    }
    curl_close($curl);
    return $response;
}
function eliminar_acentos($cadena)
{

    $cadena = str_replace(' ', '', $cadena);
    //Reemplazamos la A y a
    $cadena = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $cadena
    );

    //Reemplazamos la E y e
    $cadena = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $cadena
    );

    //Reemplazamos la I y i
    $cadena = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $cadena
    );

    //Reemplazamos la O y o
    $cadena = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $cadena
    );

    //Reemplazamos la U y u
    $cadena = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $cadena
    );

    //Reemplazamos la N, n, C y c
    $cadena = str_replace(
        array('Ñ', 'ñ', 'Ç', 'ç'),
        array('N', 'n', 'C', 'c'),
        $cadena
    );
    return $cadena;
}
function IsAjax()
{
    return (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest');
}
?>