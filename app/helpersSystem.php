<?php
///
///
function CargarPermisos($xIdUsuario)
{
    #Cargando los permisos del usuario
    $xManejador = new Usuario(null,"mysqlCliente");
    //$Sentencia=" exec _sp_perfilesModulosByIdUsuario_Leer :xIdUsuario"; //sql_server
    $Sentencia="call _sp_perfilesModulosByIdUsuario_Leer(:xIdUsuario)";
    $parametros=array("xIdUsuario"=>$xIdUsuario);
    $Modulos=$xManejador->ejecutarProcedimiento($Sentencia,$parametros);
    if(!$xManejador->Error)
    {
        foreach($Modulos as $xUnModulo)
        {
            $_SESSION[$xUnModulo->moduloname]=$xUnModulo->activovalue;
        }
    }
    else
    {
        CrearArchivo($xManejador->MensajeError,'helpersCajas|CargarPermisos()');
    }
}
function Sucursal()
{
    $xManejador = new Usuario(null,"mysqlCliente");   
    $Sentencia="select sucursal from sucursales where idSucursal=:xSucursalid";
    $parametros=array("xSucursalid"=>Sucursalid()); 
    $xDataSucursales=$xManejador->ejecutarProcedimiento($Sentencia,$parametros);  
	if(!$xManejador->Error)
	{
		if(COUNT($xDataSucursales)>0)
		{
			return $xDataSucursales[0]->sucursal;
		}
	}
    else
    {
        CrearArchivo($xManejador->MensajeError,'helpersCajas_Sucursal()');
    }
}
function Sucursalid()
{
    return $_SESSION['Sucursalid'];
}
function Sucursalnombre()
{
    return $_SESSION['Sucursal'];
}
function GetSucursalesActivas($tipoArray=false,$idSucursalExcept=0)
{
    $data=[];
    $xManejador = new Usuario(null,"mysqlCliente");   
    if($idSucursalExcept==0)
    $Sentencia="select idSucursal as xvalue,sucursal as xtext from sucursales where activo=1";
    else
    $Sentencia="select idSucursal as xvalue,sucursal as xtext from sucursales where activo=1 and idSucursal<>".$idSucursalExcept;
    $xDataSucursales=$xManejador->ejecutarProcedimiento($Sentencia,null,true,$tipoArray);                 
    if(!$xManejador->Error)
    {
        $data=$xDataSucursales;
    }
    else
    {
        CrearArchivo($xManejador->MensajeError,"helpersCajas_GetSucursalesActivas");
    }
    return $data;
}
?>