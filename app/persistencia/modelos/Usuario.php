<?php

namespace App\Persistencia\Modelos;

class Usuario extends ModeloGenerico 
{
    public $usuarioid;
    public $pass;
    public $nombre;
    public $email;
    public $puesto;
    public $division;
    public $region;
    public $uen;
    public $activo;
    public $fechacreacion;
    public $fechamodificacion;
    public $fechabaja;
    public $privilegio;
    public $visita;
    public $ultimavisita;
    public $foto;
    public $telefono;
    public $extension;
    public $acceso;
    public $estado;
    public $ciudad;
    public $horario;
    public $sector;
    public $pcompra;
    public $statusl;
    public $finicio;
    public $libera;
    public $conteo;
    public $calle;
    public $next;
    public $colonia;
    public $cp;
    public $ciudade;
    public $estadoe;
    public $categoriae;
    public $condicionp;
    public $credito;
    public $tipocredito;
    public $rfc;
    public $curp;
    public $nempresav;
    public $ncreditoe;
    public $mautorizado;
    public $banco;
    public $cuenta;
    public $clabe;
    public $nombrec;
    public $areac;
    public $telefonoc;
    public $extc;
    public $domicilioc;
    public $coloniac;
    public $ciudadc;
    public $vaempresa;
    public $arrendamiento;
    public $numeroplaza;
    public $parrendamiento;
    public $resventa;
    public $ampcontrato;
    public $autoriza;
    public $comentario;
    public $fcredito;
    public $fbaja;
    public $nlicitacion;
    public $actualizo;
    public $ruta;
    public $paisCliente;
    public $esExtranjero;

    function getusuarioid() {
        return $this->usuarioid;
    }

    function getpass() {
        return $this->pass;
    }

    function setusuarioid($usuarioid) {
        $this->usuarioid = $usuarioid;
    }

    function setpass($pass) {
        $this->pass = $pass;
    }

    public function __construct($propiedades = null,$conect="mysql") {
        parent::__construct("usuario", Usuario::class, $propiedades,$conect);
    }
}