<?php
$title = "ERROR 404";
ViewRender('front.head',compact('title'));
ViewRender("front.cierrehead.php");
?>
<br>
<div class="container">
    <div class=" card rounded-lg text-center bg-gradient-verdea">
        <div class="card-body">
        <p class="p-xl-5">
        <h1>ERROR 404</h1>
        <br>
        <h1>PÁGINA NO ENCONTRADA</h1>
        </p>
        <a href="<?=UrlTo('/')?>" class="btn btn-success">Regresar</a>
        <br><br>
        </div>
    </div>
</div>
<br>
<?php

ViewRender('front.footer'); ?>
