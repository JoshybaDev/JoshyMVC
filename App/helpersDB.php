<?php

use App\Persistencia\Modelos\SqlQuery;


function paginadorDb($tabla, $columns, $xPagina = 1, $xnumregistros = 10, $filtro = "")
{
    $filtro="%{$filtro}%";
    $resultPaginador = [];
    $resultPaginador["msjerror"] = "";
    $xProductos = new SqlQuery();
    if (empty($filtro)) {
        $xSentencia = "SELECT COUNT(*) as total from {$tabla}";
        $xPaginasDisponible = $xProductos->ejecutarProcedimiento($xSentencia)[0]->total;
    } else {
        $parametros = array($filtro,$filtro);
        $xSentencia = "SELECT COUNT(*) as total from {$tabla} where descripcion like ? or keywords like ?";
        $xPaginasDisponible = $xProductos->ejecutarProcedimiento($xSentencia, $parametros)[0]->total ?? 0;
    }
    $xvalor = ($xPagina - 1) * $xnumregistros;
    $xPaginasResto = $xPaginasDisponible % $xnumregistros;
    $xPaginasDisponible = $xPaginasDisponible - $xPaginasResto;
    $xPaginasDivision = ceil($xPaginasDisponible / $xnumregistros);
    if ($xPaginasResto > 0) :
        $xPaginasDivision = $xPaginasDivision + 1;
    endif;

    if (empty($filtro)) {
        $parametros = array($xPaginasDivision);
        $xSentencia = "SELECT {$columns},? as paginas from {$tabla} ORDER BY id DESC limit {$xvalor},{$xnumregistros}";
    } else {
        $parametros = array($xPaginasDivision, $filtro,$filtro);
        $xSentencia = "SELECT {$columns},? as paginas from {$tabla} where descripcion like ? or keywords like ? ORDER BY id DESC limit {$xvalor},{$xnumregistros}";
    }
    $xDataProductos = $xProductos->ejecutarProcedimiento($xSentencia, $parametros);
    if ($xProductos->Error) {
        $resultPaginador["msjerror"] = $xProductos->MensajeError;
    }
    $resultPaginador["xDataProductos"] = $xDataProductos ?? [];
    $resultPaginador["xnumregistros"] = $xnumregistros ?? 0;
    $resultPaginador["xPaginasDivision"] = $xPaginasDivision ?? 1;
    return $resultPaginador;
}
