<?php
$title = "ERROR 403";
ViewRender('front.head', compact('title'));
ViewRender("front.cierrehead.php");
?>
<br>
<div class="container">
    <div class=" card rounded-lg text-center bg-gradient-verdea">
        <div class="card-body">
            <p class="p-xl-5">
            <h1>ERROR 403</h1>
            <br>
            <h1>SERVICIO NO DISPONIBLE</h1>
            </p>
            <a href="<?= UrlTo('/') ?>" class="btn btn-success">Regresar</a>
            <br><br>
        </div>
    </div>
</div>
<br>
<?php

ViewRender('front.cierrefooter'); ?>