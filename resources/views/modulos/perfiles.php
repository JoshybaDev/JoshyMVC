<?php 
$title="Modulos de Call center  - Perfiles";
self::ViewRender('front/head',compact('title'));
?>
<link href="Assets/css/w3.css" rel="stylesheet">
<?php
self::ViewRender("front/cierrehead.php");
self::ViewRender('front/header');
self::ViewRender('front/nav');
?>
    <div class="card">
    <div class="card-header">Perfiles de usuario
    <?php /*
    <div class="float-right"><button class="btn btn-success" onclick="Nuevo();">Nuevo perfil</button></div>   
    */?>     
    </div>
        <div class="card-body">
        <div class="row form-group">
            <div class="col-lg-12" id="Mensajes"></div>
        </div>        
        <?php /*  
        <div style="border:1;border-style:solid;display:none" id="edicion">        
            <form action="" method="post" name="form" id="form">          
                <div class="row form-group">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="row form-group">
                            <label for="Ejecutivo">Perfil:</label>
                            <input type="text" name="perfil" id="perfil" class="form-control" readonly>
                            <label for="Ejecutivo">Perfil descripción:</label>
                            <input type="text" name="perfil" id="perfildes" class="form-control">     
                            <input type="hidden" name="id" id="id" value="">                       
                        </div>
                        <div class="row">
                            <div class="col-lg-4 text-center"><button type="button" class="btn btn-success" onclick="Guardar();">Guardar</button></div>
                            <div class="col-lg-4 text-center"><button type="button" class="btn btn-primary" onclick="Cancelar();">Cancelar</button></div>
                            <div class="col-lg-4 text-center"><button type="button" class="btn btn-danger" onclick="Eliminar();">Eliminar</button></div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </form>   
        </div>
        */?>              
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
    window.onload = function() 
    {
        cargarPerfiles();
    };
</script>
<?php self::ViewRender('front/cierrefooter');?>