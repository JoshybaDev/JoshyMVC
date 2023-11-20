<?php
$title = "Modulos de Call center";
self::ViewRender('front/head', compact('title'));
?>
<link href="Assets/css/w3.css" rel="stylesheet">
<?php
self::ViewRender("front/cierrehead.php");
self::ViewRender('front/header');
self::ViewRender('front/nav');
?>
<div class="card">
    <div class="card-header">Activación de modulos a un perfil</div>
    <div class="card-body">
        <form action="" method="post">
            <div class="row form-group">
                <div class="col-lg-12">
                    <label for="Ejecutivo">Perfiles:</label>
                    <select name="Ejecutivo" id="Ejecutivo" class="form-control" onchange="cargarModulos(this.value)">
                        <option value="Seleccione">Seleccione</option>
                        <?php
                        foreach ($Ejecutivos as $UnEjecutivo) { ?>
                            <option value="<?= $UnEjecutivo->Perfil ?>"><?= $UnEjecutivo->Perfil . " | " . $UnEjecutivo->Descripcion ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12" id="Mensajes">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 text-right">
                    <hr>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 text-right" id="DetalleContenido">
                </div>
            </div>
        </form>

    </div>
</div>
<?php
self::ViewRender('front/footer');
?>
<script src="<?= UrlTo('Assets/js/modulos/modulos.js?v='.VersionSistema())?>"></script>
<?php self::ViewRender('front/cierrefooter'); ?>