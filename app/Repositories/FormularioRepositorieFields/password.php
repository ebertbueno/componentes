<?php

$retorno .= '<div class="row">';
$retorno .= '<div class="col-md-6">';
$retorno .= '<input 
            ' . $javascript . ' 
            placeholder="' . $placeholder . '" 
            ' . $autofocus . ' 
            ' . $campoLivre . ' 
            autocomplete="off" 
            ' . $required . ' 
            ' . $readonly . ' 
            value="' . $valor_inicial . '" 
            ' . $minlength . ' 
            ' . $maxlength . ' 
            ' . $multiple . '  
            name="' . $nome_no_banco_de_dados . '' . (!empty($multiple) ? '[]' : Null) . '" 
            id="' . $nome_no_banco_de_dados . '" 
            type="password" 
            class="' . $mascara . ' ' . $cssAdicionalInput . ' form-control" ' .
    $min . ' ' .
    $max . ' 
            style="' . $style . '" />';
$retorno .= '</div>';
$retorno .= '<div class="col-md-6">';
$retorno .= '<input 
            ' . $javascript . ' 
            placeholder="' . $placeholder . '" 
            ' . $autofocus . ' 
            ' . $campoLivre . ' 
            autocomplete="off" 
            ' . $required . ' 
            ' . $readonly . ' 
            value="' . $valor_inicial . '" 
            ' . $minlength . ' 
            ' . $maxlength . ' 
            ' . $multiple . '  
            name="re-' . $nome_no_banco_de_dados . '' . (!empty($multiple) ? '[]' : Null) . '" 
            id="' . $nome_no_banco_de_dados . '" 
            type="password" 
            class="' . $mascara . ' ' . $cssAdicionalInput . ' form-control" ' .
    $min . ' ' .
    $max . ' 
            style="' . $style . '" />';
$retorno .= '</div>';
$retorno .= '</div>';