<?php
$janelasFlutuantesModulos = '<div class="col-sm-12"><div class="nav-tabs-custom"><ul class="nav nav-tabs">';

foreach( $cabecalho as $key => $cabecalhos ){
	$janelasFlutuantesModulos .= '<li class="'.($key === 0 ? 'active' : '').'"  style="width: '.round(100/count($cabecalho)).'%; text-align: left; overflow: hidden; padding: 0px; margin: 0px;"><a style="padding: 5px" href="#tab_'.$key.'" data-toggle="tab">'.$cabecalhos['label_1'].'</a></li>';
}

$janelasFlutuantesModulos .= '</ul><div class="tab-content">';

foreach( $cabecalho as $key => $cabecalhos ){
	$janelasFlutuantesModulos .= '<div class="tab-pane '.($key === 0 ? 'active' : '').'" id="tab_'.$key.'">';
	$janelasFlutuantesModulos .= 'conteudo de '.$cabecalhos['label_1'].' aqui';
	$janelasFlutuantesModulos .= '</div>';
}