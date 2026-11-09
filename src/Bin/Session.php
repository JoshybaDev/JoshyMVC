<?php

namespace   Joshyba\Joshymvc\Bin;

class Session {
			/*
	function logged_in() 
	{
		#Funcion que averigua si se esta iniciada la sesion en una intranet
		return isset($_SESSION['UserIDIntranet']);
	}
	
	function confirm_logged_in($url) 
	{
		//Confirmar si se esta logueado en una Intranet
		if(!$_SESSION['intranetadmx'])
		{
			echo "<script>window.location.href='".$_SERVER['HOST']."/Principal/'</script>";
		}
		else
		if (!logged_in()) 
		{
			redirect_to("",$url);
		}
	}
	
	function redirect_to( $location ,$url) 
	{
		//Funcion auxiliar de redireccion
		if ($location != "") 
		{
			$location=$location."?url=".$url;
			//header("Location: {$location}");
			echo "<script>window.location.href='$location'</script>";
			exit;
		}
	}
	*/
	public static function SesionActivaModulo()
	{
		# Si existe la sesion del nombre, entonces si está logueado.
		if(isset($_SESSION['nombre']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public static function SesionVerifyValue($item,$defaultValor)
	{
		if(isset($_SESSION[$item]))
		{
			return $_SESSION[$item];
		}
		else{
			return $defaultValor;
		}
	}
}
?>