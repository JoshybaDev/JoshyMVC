<?php

namespace   Joshyba\Joshymvc\Bin;

use Joshyba\Joshymvc\Bin\Errores;



class Conexion
{

    private $tipo = 'mysql';
    private $conexion;
    private $host = "localhost";
    public static $ConexionError = false;
    #configuracion Madre
    private $configuracionmysql = [
        "driver" => "mysql",
        "host" => "localhost",
        "database" => "ptvnet",
        "port" => "3306",
        "username" => "root",
        "password" => "",
        "charset" => "utf8mb4"
    ];
    private $configuracionsqlsrv = [
        "driver" => "sqlsrv",
        "host" =>  "10.44.0.10",
        "database" => "dbsqlserver+",
        "port" => "1433",
        "username" => "sa",
        "password" => "000000",
        "charset" => "UTF-8"
    ];

    public function __construct()
    {
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
                $CONTROLADOR = $this->configuracionmysql["driver"];
                $SERVIDOR = $this->configuracionmysql["host"];
                $BASE_DATOS = $this->configuracionmysql["database"];
                $PUERTO = $this->configuracionmysql["port"];
                $USUARIO = $this->configuracionmysql["username"];
                $CLAVE = $this->configuracionmysql["password"];
                $CODIFICACION = $this->configuracionmysql["charset"];
                $url = "{$CONTROLADOR}:host={$SERVIDOR}:{$PUERTO};" . "dbname={$BASE_DATOS};charset={$CODIFICACION}";
            } elseif ($this->tipo == "sqlsrv") {
                $CONTROLADOR = $this->configuracionsqlsrv["driver"];
                $SERVIDOR = $GLOBALS['hostglobal']; //$this->configuracionsqlsrv["host"];
                $BASE_DATOS = $this->configuracionsqlsrv["database"];
                $PUERTO = $this->configuracionsqlsrv["port"];
                $USUARIO = $this->configuracionsqlsrv["username"];
                $CLAVE = $this->configuracionsqlsrv["password"];
                $CODIFICACION = $this->configuracionsqlsrv["charset"];
                $url = "{$CONTROLADOR}:server={$SERVIDOR};" . "database={$BASE_DATOS}";
            }
            //Se crea la conexión.
            $this->conexion = new \PDO($url, $USUARIO, $CLAVE);
            if ($this->tipo == "sqlsrv") {
                $this->conexion->setAttribute(\PDO::SQLSRV_ATTR_ENCODING, \PDO::SQLSRV_ENCODING_UTF8);
            }
            $this->conexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $this->conexion;
        } catch (\Exception $exc) {
            Conexion::$ConexionError = true;
            $xmsj = "";
            $xmsj = "Hay un error de conexión | " . $exc->getMessage() . $exc->getTraceAsString();
            CrearArchivo($xmsj, 'conexion');
            return Errores::Error(403);
        }
    }
}
