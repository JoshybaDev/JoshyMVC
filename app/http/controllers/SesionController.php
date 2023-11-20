<?php

namespace   App\Http\Controllers;

use Joshyba\Joshymvc\Bin\URL;
use Joshyba\Joshymvc\Bin\CSFR;
use Joshyba\Joshymvc\Bin\Session;
use Joshyba\Joshymvc\Router\Request;
use App\Persistencia\Modelos\Usuario;

class SesionController extends Controller
{
    
    public function index()
    {
        //confirm_logged_in("/"); Solo si forma parte de otros proyecto en la raiz como una Intranet
        $variables['usuario']="";
        $variables['msjerror']="";
        //$MiCaja=ObtenerInfoCaja();
        $variables['cajaid']=0;
        $variables['cajanombre']="";
        if(Session::SesionActivaModulo())
        {
            return Redirect(URL::to('menu'));
        }
        else
        {
            return $this->view("front/login",$variables);
        }
    }

    public function login(Request $request)
    {
        $msjerror="";
        $NumCliente=$request->numCliente;
        $variables['usuario']=$request->user;
        $variables['msjerror']="";
        $Usuario = new Usuario();
        $Sentencia="select valor001,valor999,valor500 from clientes WHERE numcliente=:xnumCliente";
        $parametros=array("xnumCliente"=>$NumCliente);
        $xDataClientePtv=$Usuario->ejecutarProcedimiento($Sentencia,$parametros);
        if(!$Usuario->Error)
        {
            //var_dump("xDataClientePtv",$xDataClientePtv,$NumCliente);
            if(count($xDataClientePtv)>0)
            {
                $_SESSION['db_Cliente']=$xDataClientePtv[0]->valor001;
                $_SESSION['db_ClienteUser']=$xDataClientePtv[0]->valor999;
                $_SESSION['db_ClientePass']=$xDataClientePtv[0]->valor500;   
                return $this->view("front/login2",$variables);                  
            }
            else
            {
                $msjerror="Número de Cliente inválido.";
            }
        }
        else
        {
            $msjerror=$Usuario->MensajeError;
        }
        $variables['msjerror']=$msjerror;
        return $this->view("front/login",$variables);
    }

    public function login2(Request $request)
    {
        $msjerror="";
        $User=$request->user;
        $Pass=$request->password;
        $CajaId=$request->cajaid;
        $xidSucursal=$request->sucursal;
        $xCliente = new Usuario(null,"mysqlCliente");
        $Sentencia="select * from usuarios WHERE usuario=:xusuario and activo=1";
        $parametros=array("xusuario"=>$User);
        $xDataUsuarios=$xCliente->ejecutarProcedimiento($Sentencia,$parametros); 
        if(!$xCliente->Error)
        {
            if(count($xDataUsuarios)>0 )
            {
                if(password_verify($Pass,$xDataUsuarios[0]->pass))
                {
                    
                    $_SESSION['Sucursalid']=$xidSucursal;
                    $_SESSION['CajaId']=$CajaId;
                    $_SESSION['IdCajaMovi']=0;
                    $_SESSION['CajaNombre']=MiCajaGetNombre();
                    $_SESSION["CajaEstatus"]='CERRADA';
                    $_SESSION['idUsuario']=$xDataUsuarios[0]->idUsuario;
                    CargarPermisos($_SESSION['idUsuario']);
                    $_SESSION['nombre']=$xDataUsuarios[0]->nombre;
                    $_SESSION['email']=$xDataUsuarios[0]->email;
                    $_SESSION['perfil']=$xDataUsuarios[0]->perfil;
                    $_SESSION['Sucursal']=Sucursal();
                    if($_SESSION['perfil']=='Cajero')
                    {
                        MiCajaEstaAbierta();
                        return Redirect('ptv');
                    }
                    else
                    {
                        return Redirect('/'); 
                    }
                }
                else
                {
                    $msjerror="Usuario o Contraseña incorrecta.";
                }
            }
            else
            {
                $msjerror="Usuario o Contraseña incorrecta.";
            }
        }
        else
        {
            $msjerror=$xCliente->MensajeError;
        }                          
        $variables['usuario']=$request->user;
        $variables['msjerror']=$msjerror;
        return $this->view("front/login2",$variables);
    }   

    public function CerrarLaSesion()
    {
        if(Session::SesionActivaModulo())
        {
            unset($_SESSION['idUsuario']);
            unset($_SESSION['nombre']);
            unset($_SESSION['email']);
            CSFR::Token_csrf_token_reset();
            //unset($_SESSION['puesto']);
            //unset($_SESSION['telefono']);
            //unset($_SESSION['privilegio']);
            session_destroy(); #Destruye toda la sesión
            return Redirect('menu');
        }
        return Redirect(URL::to('menu'));
    }
}
?>