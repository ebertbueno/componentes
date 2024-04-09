<?php
$botao = '';

$botao .= '<a onclick="' . trataUrlparaFuncao($url) . ';" style="cursor: pointer">';
$botao .= '<li data- data-toggle="tooltip" title="' . $titulo . '" style="list-style: none; ' . $style . '">';
$botao .= $icone;
$botao .= $label;
$botao .= '</li>';
$botao .= '</a>';
