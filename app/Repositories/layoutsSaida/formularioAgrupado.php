<?php

use App\Repositories\FormularioRepositorie;

$retorno = '<div class="col-md-' . ($data['tamanho'] ?? 12) . '" style="margin-bottom: 20px !important;">';
$retorno .= '<div class="ibox" style="background-color: #F6F6F6; font-size: 12px !important; border:1px solid #F1F1F1; margin: 0px !important; padding: 10px !important">';
$retorno .= '<div style="padding: 5px !important; font-weight: bold !important">';

$retorno .= '<div class="d-flex flex-stack">';
$retorno .= '<div class="fw-bold fs-4">' . ___($data['label']);
$retorno .= '</div>';
$retorno .= '</div>';
$retorno .= '<div class="h-3px w-100 bg-' . ($data['cor'] ?? 'primary') . '"></div>';

// $retorno .= '<h5>' . (___($data['label']) ?? Null) . '</h5>';
$retorno .= '</div>';
$retorno .= '<div class="ibox-content" style="padding: 5px !important">';
$retorno .= '<div class="row">';

foreach ($data['data'] as $key => $d) {
    $retorno .= FormularioRepositorie::formulario($d);
}

$retorno .= '</div>';
$retorno .= '</div>';
$retorno .= '</div>';
$retorno .= '</div>';

return $retorno;
