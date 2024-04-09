<?php

$retorno = '<style>';
$retorno .= '.form-check-input:checked{';
$retorno .= 'background-color: ' . $cor_fundo . '';
$retorno .= 'box-shadow: 0px';
$retorno .= '}';
$retorno .= '.form-check-input{';
$retorno .= 'box-shadow: 1px 1px 1px #000';
$retorno .= '}';
$retorno .= '</style>';

$retorno .= '<div style="padding: 5px 10px !important;">';
$retorno .= '<label class="form-check form-switch form-check-custom form-check-solid">';
$retorno .= '<input class="form-check-input" type="checkbox" value="" ' . $checked . ' name="' . $nome_no_banco_de_dados . '" id="' . $nome_no_banco_de_dados . '" />';
$retorno .= '</label>';
$retorno .= '</div>';
