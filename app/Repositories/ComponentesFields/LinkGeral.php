<?php
$botao = '';

$botao .= '<a onclick="' . trataUrlparaFuncao($url) . ';" style="cursor: pointer" id="' . deixaApenasTexto($titulo . $label) . '">';
$botao .= '<li class="btn btn-sm btn-block btn-' . $cor . '" data- data-toggle="tooltip" title="' . $titulo . '" style="' . $style . '">';
$botao .= $icone;
$botao .= $label;
$botao .= '</li>';
$botao .= '</a>';
