<?php

namespace   Joshyba\Joshymvc\Bin;

class CSFR
{

	public static function Token_RetornaHTML_CsFr()
	{
		echo '<input type="hidden" name="_token" value=' . self::Token_csrf_token() . '>';
	}
	public static function Token_csrf_token()
	{
		return self::Token_CsFr_Create();
	}
	public static function Token_csrf_token_reset()
	{
		unset($_SESSION['_token']);
		self::Token_CsFr_Create();
	}

	public static function SeEnvioToken()
	{
		$errorTokenCSFR = true;
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$headers = isset($_POST) ? $_POST : null;
			$existeToken = false;
			$xToken = null;
			foreach ($headers as $key => $value) {
				if ($key == '_token') {
					$xToken = $value;
					$existeToken = true;
					break;
				}
			}
			if (!$existeToken) {
				echo Errores::Error(409);
			} else {
				if (!self::Token_CsFr_Validate($xToken)) {
					echo Errores::Error(409);
				} else {
					$errorTokenCSFR = false;
				}
			}
		} else {
			$errorTokenCSFR = false;
		}
		return $errorTokenCSFR;
	}
	public static function Token_CsFr_Create()
	{
		if (empty($_SESSION['_token'])) {
			if (function_exists('mcrypt_create_iv')) {
				$_SESSION['_token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
			} else {
				$_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(32));
			}
		}
		return $_SESSION['_token'];
	}
	public static function Token_CsFr_Validate($xToken)
	{
		$xValor = false;

		if (hash_equals(self::Token_csrf_token(), $xToken)) {
			$xValor = true;
		} else {
			$xValor = false;
		}
		//echo $xValor;
		return 	$xValor;
	}
}
