<?php
use App\Repositories\Componentes;

$copiarTexto = '';

$botao = ( !empty($botao) ? $botao : 'copiar' );
$campoCopiar = ( !empty($botao) ? $botao : 'origem' );
$mensagem = ( !empty($mensagem) ? $mensagem : ___('Copiado para área de transferência') );

$copiarTexto = "<script>";
$copiarTexto .= "$('#".$botao."').click(function(){";
$copiarTexto .= "$('#".$campoCopiar."').select();";
$copiarTexto .= "try {";
$copiarTexto .= "var ok = document.execCommand('copy');";
$copiarTexto .= "if (ok) { alert('".$mensagem."'); }";
$copiarTexto .= "} catch (e) {";
$copiarTexto .= "alert(e)";
$copiarTexto .= "}";
$copiarTexto .= "});";
$copiarTexto .= "</script>";