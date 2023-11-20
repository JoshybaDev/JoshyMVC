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
            <form class="user" method="post" action="">
              <?=GetTokenCsfrHTML()?>
              <div class="form-group">
                <input type="text" name="numCliente" id="numCliente" class="form-control form-control-user text-center" aria-describedby="emailHelp" placeholder="Número de cliente" required>
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
<?php ViewRender("front.cierrefooter.php"); ?>