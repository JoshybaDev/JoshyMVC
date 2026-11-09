<?php

namespace   App\Http\Controllers;

use Joshyba\Joshymvc\Router\Request;
use App\Persistencia\Modelos\Usuarios;

class ControladorUsuarios extends Controller{

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        # code...
        return $this->view("prueba/inicio");
    }

    public function formCrearUsuario() {
        
        return $this->view("prueba/usuarios/registrarusuario");
    }

    public function insertarUsuario(Request $request) {
        $usuarioModel = new Usuarios();
        $usuario = $usuarioModel->where("correo", "=", $request->correo)->first();
        if ($usuario) {
            return new Respuesta(EMensajes::ERROR, "El correo ya se encuentra registrado.");
        }
        $id = $usuarioModel->insert($request->all());
        $v = ($id > 0);
        $respuesta = new Respuesta($v ? EMensajes::INSERCION_EXITOSA : EMensajes::ERROR_INSERSION);
        $respuesta->setDatos($id);
        return $respuesta;
    }

    public function listarUsuarios() {
        $usuarioModel = new Usuarios();
        $lista = $usuarioModel->get();
        $v = count($lista);
        $respuesta = new Respuesta($v ? EMensajes::CORRECTO : EMensajes::ERROR);
        $respuesta->setDatos($lista);
        return $respuesta;
    }

    public function actualizarUsuario($usuario) {
        $usuarioModel = new Usuarios();
        $actualizados = $usuarioModel->where("id", "=", $usuario["idUsuario"])
                ->update($usuario);
        return [
            "codigo" => (($actualizados > 0) ? 1 : -1),
            "mensaje" => ($actualizados > 0) ? "Se ha actualizado el usuario correctamente." : "No se pudo actualizar el usuario.",
            "datos" => $actualizados
        ];
    }

    public function eliminarUsuario($idUsaurio) {
        $usuarioModel = new Usuarios();
        $eliminados = $usuarioModel->where("id", "=", $idUsaurio)->delete();
        return [
            "codigo" => (($eliminados > 0) ? 1 : -1),
            "mensaje" => ($eliminados > 0) ? "Se ha eliminado el usuario correctamente." : "No se pudo eliminado el usuario.",
            "datos" => $eliminados
        ];
    }

    public function buscarUsuarioPorId($idUsuario) {
        $usuarioModel = new Usuarios();
        $usuario = $usuarioModel->where("id", "=", $idUsuario)->first();
        return [
            "codigo" => (($usuario != null) ? 1 : -1),
            "mensaje" => ($usuario != null) ? "Se ha consultado el usuario correctamente." : "No se pudo consultar el usuario.",
            "datos" => $usuario
        ];
    }

}
