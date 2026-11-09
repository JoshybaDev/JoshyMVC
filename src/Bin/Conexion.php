<?php

namespace   Joshyba\Joshymvc\Bin;

use Joshyba\Joshymvc\Bin\Errores;



class Conexion
{

    private $tipo = 'mysql';
    private $conexion;
    private $host = "localhost";
    public static $conexionError = false;
    private $configuracionmysql = [
            "driver" => "mysql",
            "host" => "",
            "database" => "",
            "port" => "3306",
            "username" => "",
            "password" => "",
            "charset" => "utf8mb4"
        ];
    private $configuracionsqlsrv = [
            "driver" => "sqlsrv",
            "host" =>  "",
            "database" => "",
            "port" => "1433",
            "username" => "",
            "password" => "",
            "charset" => "UTF-8"
        ];

    public function __construct()
    {
        $this->configuracionmysql["host"]=$_ENV['DB_HOST'];
        $this->configuracionmysql["database"]=$_ENV['DB_NAME'];
        $this->configuracionmysql["username"]=$_ENV['DB_USER'];
        $this->configuracionmysql["password"]=$_ENV['DB_PASS'];
        $this->configuracionsqlsrv["hostglobal"]=$_ENV['DB_HOST'];
        $this->configuracionsqlsrv["database"]=$_ENV['DB_NAME'];
        $this->configuracionsqlsrv["username"]=$_ENV['DB_USER'];
        $this->configuracionsqlsrv["password"]=$_ENV['DB_PASS'];
    }

    public function conectar($conect = "mysql")
    {
        try {
            $this->tipo = $conect;
            if ($this->tipo == "mysqlCliente") {
                $this->configuracionmysql["database"] = isset($_SESSION["db_Cliente"]) ? $_SESSION["db_Cliente"] : "mysql";
                $this->configuracionmysql["username"] = isset($_SESSION["db_ClienteUser"]) ? $_SESSION["db_ClienteUser"] : "";
                $this->configuracionmysql["password"] = isset($_SESSION["db_ClientePass"]) ? $_SESSION["db_ClientePass"] : "";
            }
            if ($this->tipo == "mysql" || $this->tipo == "mysqlCliente") {
                $controlador = $this->configuracionmysql["driver"];
                $servidor = $this->configuracionmysql["host"];
                $base_Datos = $this->configuracionmysql["database"];
                $puerto = $this->configuracionmysql["port"];
                $usuario = $this->configuracionmysql["username"];
                $clave = $this->configuracionmysql["password"];
                $codificacion = $this->configuracionmysql["charset"];
                $url = "{$controlador}:host={$servidor}:{$puerto};" . "dbname={$base_Datos};charset={$codificacion}";
            } elseif ($this->tipo == "sqlsrv") {
                $controlador = $this->configuracionsqlsrv["driver"];
                $servidor = $GLOBALS['hostglobal'];
                $base_Datos = $this->configuracionsqlsrv["database"];
                $puerto = $this->configuracionsqlsrv["port"];
                $usuario = $this->configuracionsqlsrv["username"];
                $clave = $this->configuracionsqlsrv["password"];
                $codificacion = $this->configuracionsqlsrv["charset"];
                $url = "{$controlador}:server={$servidor};" . "database={$base_Datos}";
            }
            //Se crea la conexión.
            $this->conexion = new \PDO($url, $usuario, $clave);
            if ($this->tipo == "sqlsrv") {
                $this->conexion->setAttribute(\PDO::SQLSRV_ATTR_ENCODING, \PDO::SQLSRV_ENCODING_UTF8);
            }
            $this->conexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $this->conexion;
        } catch (\Exception $exc) {
            Conexion::$conexionError = true;
            $xmsj = "";
            $xmsj = "Hay un error de conexión | " . $exc->getMessage() ."<BR>". $exc->getTraceAsString();
            CrearArchivo($xmsj, 'conexion');
            return Errores::Error(403);
        } catch (\PDOException $exc) {
            Conexion::$conexionError = true;
            $xmsj = "";
            $xmsj .= "Hay un error de conexión | <BR>";
            $xmsj .= $exc->getMessage() ."<BR>";
            $xmsj .= $exc->getTraceAsString() ."<BR>";
            $xmsj .= $exc->getLine() ."<BR>";
            $xmsj .= $exc->getLine() ."<BR>";
            CrearArchivo($xmsj, 'conexion');
            return Errores::Error(403);
        }
    }
}
