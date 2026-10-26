<?php

namespace   Joshyba\Joshymvc\Bin;

class Crud
{

    protected $tabla;
    protected $conexion;
    protected $wheres = "";
    protected $sql = null;
    public $MensajeError = "";
    public  $Error = false;
    public $FilasAfectadas = 0;

    public function __construct($tabla = null, $conect = "mysql")
    {
        $this->conexion = (new Conexion())->conectar($conect);
        $this->tabla = $tabla;
    }

    public function Conexion()
    {
        return $this->conexion;
    }

    public function ejecutarProcedimiento($sentencia, $obj = null, $regresaalgo = true,$tipoArray=false)
    {
        try {
            if (!Conexion::$ConexionError) {
                $sth = $this->conexion->prepare($sentencia);
                if($sth)
                {
					if ($obj !== null) {
						$result = $sth->execute($obj);
					}else{
						$result = $sth->execute();
					}					 
                    $this->FilasAfectadas = $sth->rowCount();
                    if ($result) {
                        if ($regresaalgo) {
                            if($tipoArray)
                            {
                                return $sth->fetchAll(\PDO::FETCH_ASSOC);
                            }
                            else
                            {
                                return $sth->fetchAll(\PDO::FETCH_OBJ);
                            }
                            
                        } else {
                            return true;
                        }
                    } else {
                        $errorInfo = "";
                        foreach ($sth->errorInfo() as $key => $value) {
                            $errorInfo .= $value;
                        }
                        $this->Error = true;
                        $this->MensajeError .= $errorInfo;
                    }                    
                }
                else
                {
                    $errorInfo = "";
                    foreach ($this->conexion->errorInfo() as $key => $value) {
                        $errorInfo .= $value;
                    }
                    $this->Error = true;
                    $this->MensajeError .= $errorInfo;
                }
            } else {
                $this->Error = true;
            }
        } catch (\PDOException  $exc) {
            $this->Error = true;
            $this->MensajeError .= $exc->getMessage();
            $errorInfo = "";
            foreach ($this->conexion->errorInfo() as $key => $value) {
                $errorInfo .= $value;
            }
            $this->Error = true;
            //$errorInfo=str_replace("<br />","",$errorInfo);
            $this->MensajeError .= $errorInfo;            
            CrearArchivo($exc->getMessage() . $exc->getTraceAsString(),'conexion');
        }
        catch (\Exception $exc) {
            $this->Error = true;
            $this->MensajeError .= $exc->getMessage();
            CrearArchivo($exc->getMessage() . $exc->getTraceAsString(),'conexion');
        }
    }
    public function ejecutarDirecto($sql)
    {
        try {
            if (!Conexion::$ConexionError) {
                $exito = $this->conexion->query($sql);
                if ($exito == false) {
                    $this->Error = true;
                    $this->MensajeError = $this->conexion->errorInfo();
                    return array();
                }
                return $exito->fetchAll(\PDO::FETCH_OBJ);
            } else {
                $this->Error = true;
            }
        } catch (\PDOException  $exc) {
            $this->Error = true;
            $this->MensajeError = $exc->getMessage() . $exc->getTraceAsString();
        }
    }

    public function Commit()
    {
        return $this->conexion->Commit();
    }
    public function RollBack()
    {
        return $this->conexion->RollBack();
    }
    public function BeginTransaction()
    {
        return $this->conexion->BeginTransaction();
    }
    public function get()
    {
        try {
            $this->sql = "SELECT * FROM {$this->tabla} {$this->wheres}";
            $sth = $this->conexion->prepare($this->sql);
            $sth->execute();
            return $sth->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException  $exc) {
            echo '<div class="alert-danger">';
            echo $exc->getMessage();
            echo '<br/><br/>';
            echo $exc->getTraceAsString();
            echo '</dvi>';
        }
    }

    public function first()
    {
        $lista = $this->get();
        if (count($lista) > 0) {
            return $lista[0];
        } else {
            return null;
        }
    }

    public function insert($obj)
    {
        try {
            $campos = implode("`, `", array_keys($obj)); //nombre`, `apellido`, `edad
            $valores = ":" . implode(", :", array_keys($obj)); //:nombre, :apellido, :edad
            $this->sql = "INSERT INTO {$this->tabla} (`{$campos}`) VALUES ({$valores})";
            $this->ejecutar($obj);
            $id = $this->conexion->lastInsertId();
            return $id;
        } catch (\PDOException  $exc) {
            echo '<div class="alert-danger">';
            echo $exc->getMessage();
            echo '<br/><br/>';
            echo $exc->getTraceAsString();
            echo '</dvi>';
        }
    }

    public function update($obj)
    {
        try {
            $campos = "";
            foreach ($obj as $llave => $valor) {
                $campos .= "`$llave`=:$llave,"; //`nombres`=:nombres,`edad`=:edad
            }
            $campos = rtrim($campos, ",");
            $this->sql = "UPDATE {$this->tabla} SET {$campos} {$this->wheres}";
            $filasAfectadas = $this->ejecutar($obj);
            return $filasAfectadas;
        } catch (\PDOException  $exc) {
            echo '<div class="alert-danger">';
            echo $exc->getMessage();
            echo '<br/><br/>';
            echo $exc->getTraceAsString();
            echo '</dvi>';
        }
    }

    public function delete()
    {
        try {
            $this->sql = "DELETE FROM {$this->tabla} {$this->wheres}";
            $filesAfectadas = $this->ejecutar();
            return $filesAfectadas;
        } catch (\PDOException  $exc) {
            echo '<div class="alert-danger">';
            echo $exc->getMessage();
            echo '<br/><br/>';
            echo $exc->getTraceAsString();
            echo '</dvi>';
        }
    }

    public function where($llave, $condicion, $valor)
    {
        $this->wheres .= (strpos($this->wheres, "WHERE")) ? " AND " : " WHERE ";
        $this->wheres .= "`$llave` $condicion " . ((is_string($valor)) ? "\"$valor\"" : $valor) . " ";
        return $this;
    }

    public function orWhere($llave, $condicion, $valor)
    {
        $this->wheres .= (strpos($this->wheres, "WHERE")) ? " OR " : " WHERE ";
        $this->wheres .= "`$llave` $condicion " . ((is_string($valor)) ? "\"$valor\"" : $valor) . " ";
        return $this;
    }

    private function ejecutar($obj = null)
    {
        $sth = $this->conexion->prepare($this->sql);
        if ($obj !== null) {
            foreach ($obj as $llave => $valor) {
                if (empty($valor)) {
                    $valor = NULL;
                }
                $sth->bindValue(":$llave", $valor);
            }
        }
        $sth->execute();
        $this->reiniciarValores();
        return $sth->rowCount();
    }

    private function reiniciarValores()
    {
        $this->wheres = "";
        $this->sql = null;
    }
}
