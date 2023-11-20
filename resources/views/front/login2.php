<?php
$GLOBALS['title'] = "Acceso";
ViewRender("front.head.php"); ?>

<?php ViewRender("front.cierrehead.php"); ?>
<?php ViewRender("front.header.php"); ?>


<div class="container">
    <div class="row p-lg-5">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="card bg-gradient-verdea">
                <div class="card-title text-center text-primary font-size-lg">
                    <h4>Bienvenido al sistema Web PTVNET</h4>
                    Muy buen día!!
                </div>
                <div class="card-body">
                    <div class="container">
                        <?php
                        if (strlen($msjerror) > 0) {
                        ?>
                            <div class="alert alert-danger"><?= $msjerror ?></div>
                        <?php
                        }
                        ?>
                        <form class="user" method="post" action="login2">
                        <?=GetTokenCsfrHTML()?>
                        <div class="form-group">
                                <select name="sucursal" id="sucursal" class="form-control" onchange="cargarCajas(this.value)" required>                            
                                </select>
                            </div>                        
                            <div class="form-group">
                                <select name="cajaid" id="cajaid" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="user" id="user" class="form-control form-control-user text-center" aria-describedby="emailHelp" placeholder="Usuario" required value="<?php echo $usuario; ?>">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user text-center" id="Password" placeholder="Contraseña" required value="">
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" value="Aceptar" class="btn3 btn3-success btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>

<?php ViewRender("front.footer.php"); ?>
<script src="Assets/js/modulos/login.js"></script>
<?php ViewRender("front.cierrefooter.php"); ?>