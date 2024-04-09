<?php

$retorno = '<div class="form-group row" style="width: 100%;">';
$retorno .= '<label class="col-sm-' . $tamLabel . ' col-form-label">' . $required_label . ___($label) . '</label>';
$retorno .= '<div class="col-sm-' . $tamDiv . '">';
$retorno .= '<div class="input-group m-b">';
$retorno .= $mostraIconeA;
$retorno .= '<div class="form-control">';
$retorno .= '<div class="col-sm-10">';
foreach ($data['campos'] as $key => $c) {
    $retorno .= '<input type="radio" name="' . $nome_no_banco_de_dados . '" id="' . $nome_no_banco_de_dados . '" value="' . $c . '">';
    $retorno .= '<label>';
    $retorno .= formataMoedaCompleta($c, 2, true);
    $retorno .= '</label>';
}
$retorno .= '</div>';
$retorno .= '</div>';
$retorno .= '</div>';
$retorno .= $msg_base;
$retorno .= '</div>';
$retorno .= '</div>';
