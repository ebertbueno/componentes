<?php
// $saida .= '<div class="row">';
$saida .= '<div class="col-md-'.$formulario.'">';
$saida .= '<label class="col-md-12 col-form-label" style="line-height:1 !important; font-weight: bold !important">'.$required_label . ___($label).'</label>';
$saida .= $retorno;
$saida .= '</div>';
$saida .= $msg_complementar;
// $saida .= '</div>';