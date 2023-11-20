</head>
<?php

$xevitarRefrehs=isset($EvitarRefrehs)?$EvitarRefrehs:false;
$xmodulo=isset($xModulo)?$xModulo:''; 
$comillasimple="'";
?>
<body data-urlbase="<?= UrlBase() ?>"<?=$xevitarRefrehs==true?' onKeyDown="javascript:verificar('.$comillasimple.$xmodulo.$comillasimple.')"':''?>  >