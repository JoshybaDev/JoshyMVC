<?php
$title = "Modulos de Call center  - Perfiles";
self::ViewRender('front/head', compact('title'));
?>
<link href="Assets/css/w3.css" rel="stylesheet">
<?php
self::ViewRender("front/cierrehead.php");
self::ViewRender('front/header');
self::ViewRender('front/nav');
?>


    <br />
    <div class="card">
        <div class="card-header">
            Usuarios
            <div class="float-right"><button class="btn btn-success" onclick="NuevoUsuario();">Nuevo Usuario</button></div>
        </div>
        <div class="card-body">
            <div class="row form-group">
                <div class="col-lg-12" id="Mensajes"></div>
            </div>
            <div class="card m-5 ml-5" id="edicionuser" style="display:none">
                <div class="card-header bg-success">
                    Nuevo Usuario
                </div>
                <div class="card-body">
                    <form action="" method="post" name="form" id="formedicionuser">
                    <input type="hidden" name="id" id="id" value="0">
                    <?=Token_RetornaHTML_CsFr()?>
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <label for="Usuario">Usuario:</label>
                                <input type="text" name="Usuario" id="Usuario" class="form-control" maxlength="20">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" maxlength="200">
                            </div>
                        </div>                        
                        <div class="row form-group">
                        <div class="col-lg-12">
                                <label for="pass1">Contraseña:</label>
                                <input type="password" name="pass1" id="pass1" class="form-control" maxlength="15">
                            </div>                            
                        </div>
                        <div class="row form-group">
                        <div class="col-lg-12">
                                <label for="pass2">Contraseña:</label>
                                <input type="password" name="pass2" id="pass2" class="form-control" maxlength="15">
                            </div>                            
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-4 text-center"><button type="button" class="btn btn-success" onclick="guardarUsuario();">Guardar</button></div>
                            <div class="col-lg-4 text-center"><button type="button" class="btn btn-primary" onclick="cancelarUsario();">Cancelar</button></div>
                            <!-- <div class="col-lg-4 text-center"><button type="button" class="btn btn-danger" onclick="EliminarUsuario();">Eliminar</button></div> -->
                        </div>
                    </form>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12">&nbsp;</div>
            </div>            
            <div class="row form-group">
                <div class="col-lg-12 text-right" id="DetalleContenido">
                </div>
            </div>

        </div>
    </div>

<?php
self::ViewRender('front/footer');
?>
<script src="<?= UrlTo('Assets/js/modulos/modulos.js?v='.VersionSistema())?>"></script>
<script>
    window.onload = function() {
        cargarUsuarios();
    };
</script>
<?php self::ViewRender('front/cierrefooter'); ?>