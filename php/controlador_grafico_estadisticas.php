<?php
    require 'modelo_grafico_estadisticas.php';

    $MG = new Modelo_Grafico();
    $consulta = $MG -> TraerDatosGraficoBar();
    echo json_encode($consulta);
?>