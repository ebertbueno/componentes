<?php
$botao = '';
$botao .= '<button style="width: 100% !important; ' . $style . '" type="submit" class="btn btn-' . $cor . ' btn-block" id="botaoEnviar">';
$botao .= ($icone ?? Null);
$botao .= ($titulo ?? Null);
$botao .= '</button>';