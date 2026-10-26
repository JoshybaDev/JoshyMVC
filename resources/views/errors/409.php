<?php
$title = "ERROR 409";
ViewRender('front.head', compact('title'));
ViewRender("front.cierrehead.php");
?>
<br>
<div class="container">
    <div class=" card rounded-lg text-center bg-gradient-verdea">
        <div class="card-body">
            <p class="p-xl-5">
            <h1>ERROR 409</h1>
            <br>
            <h1>PÁGINA NO ENCONTRADA</h1>
            <?php
            $msjerror = getSessionUnaVez("error", $msjerror ?? "");
            if (strlen($msjerror) > 0) : ?>
                <div class="alert alert-danger"><?= $msjerror ?></div>
            <?php
            endif;
            ?>
            </p>
            <a href="javascript:history.back()" class="btn btn-success">Regresar</a>
            <br><br>
        </div>
    </div>
</div>
<br>
<?php
ViewRender('front.cierrefooter'); ?>