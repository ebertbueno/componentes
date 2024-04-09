<?php
$botao = '<a style="cursor: pointer;" data-toggle="modal" data-target="#' . $modalNome . '" id="' . deixaApenasTexto($titulo . $label) . '">';
$botao .= '<li class="btn ' . $cor . '" data- data-toggle="tooltip" title="' . $titulo . '" style="' . $style . '">';
$botao .= $icone;
$botao .= $label;
$botao .= '</li>';
$botao .= '</a>';


$botao .= '<div class="modal inmodal" id="' . $modalNome . '" tabindex="-1" role="dialog"  aria-hidden="true">';
$botao .= '<div class="modal-dialog modal-' . $modalTamanho . '">';
$botao .= '<div class="modal-content animated ' . $modalEfeito . '">';
$botao .= '<div class="modal-body">';
$botao .= $modalConteudo;
$botao .= '</div>';
$botao .= '<div class="modal-footer">';
$botao .= '<button type="button" class="btn btn-white" data-dismiss="modal">' . ___('Fechar') . '</button>';
$botao .= '</div>';
$botao .= '</div>';
$botao .= '</div>';
$botao .= '</div>';
