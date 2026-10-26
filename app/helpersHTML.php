<?php
/**
 * alertHTML
 *
 * @param [string] $clase
 * @param [string] $msg
 * @return string
 */
function alertHTML($clase,$msg):string
{
    return '<div class="alert alert-' . $clase . '" alert-dismissible fade show role="alert">
    <h5 class="alert-heading">Usuarios <div class="float-right"><button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button></div></h5>
    ' . $msg . '
    </div>';
}
/**
 * Retorna los options desde un array dado.
 *
 * @access private
 * @param [Array] $array Listado del Select solo se acepta del tipo array
 * @param [string] $display Nombre del campo a visualizar
 * @param [string] $val Nombre del campo del valor
 * @param [boolean] $addselectmsg Por default es false, si es true añade la option con la frase visible SELECCIONE UNA OPCIÓN
 * @param [string] $msgDefault Por defaul muestra 'SELECCIONE UNA OPCIÓN' 
 * @param [int] $idSeleccionado Por default -1 si es mayor que cero se seleccionará ese indice
 * @return void
 */
function OptionSelect($array,$display,$val,$addselectmsg=false,$msgDefault='SELECCIONE UNA OPCIÓN',$idSeleccionado=-1)
{
    $options="";
    $seleccionadoFrase='';
    $index=0;
    if($addselectmsg)
    {
        $options.='<option value="">'.$msgDefault.'</option>';
    }
    foreach ($array as $key => $value) {
        if($idSeleccionado==$index)
        {
            $seleccionadoFrase='selected';
        }
        else
        {
            $seleccionadoFrase='';
        }
        $options.='<option value="'.$value[$val].'" '.$seleccionadoFrase.'>'.$value[$display].'</option>';
        $index++;
    }
    return $options;
}
/**
 * Undocumented function
 *
 * @param [type] $msg
 * @param string $tipo success danger warning primary
 * @return void
 */
function RetornarAlert($msg,$tipo='success')
{
    $cad='
    <div class="alert alert-'.$tipo.'">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    '.$msg.'
    </div>';
    return $cad;
}
function ReturnHTMLChecked($value){
    return $value ? "checked" : "";
}
?>