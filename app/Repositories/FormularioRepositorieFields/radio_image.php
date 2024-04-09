<?php
$option = '';
foreach( ConsultasRepositore::ConsultasRepositore($tabela_relacional) as $dado ){
	$selecionado = ( $valor_inicial === $dado['value'] ? 'selected="selected"' : 'vazio' );
	$option .= '<option '.$selecionado.' value="'.$dado['value'].'">'.$dado['label_1'].( isset($dado['label_2']) ? ' - ' . $dado['label_2'] : '' ).'</option>';
}

$retorno .= 'radio_image';