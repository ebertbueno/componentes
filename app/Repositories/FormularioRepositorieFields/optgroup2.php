<?php
use App\Repositories\ConsultasRepositore;

$option = '';
$valor_relacional = ConsultasRepositore::ConsultasRepositore($tabela_relacional);
foreach($valor_relacional as $key => $dado ){
	$option .= '<option label="'.$dado['label_1'].'" '.( count($dado[$chave_tabela_relacional]) > 0 ? ' disabled="disabled"' : Null ).'>'.$dado['label_1'].'</option>';
	foreach($dado[$chave_tabela_relacional] as $key2 => $filhos ){
		$selecionado = ( $valor_inicial === $filhos['value'] ? 'selected="selected"' : 'vazio' );
		$option .= '<option '.$selecionado.' value="'.$filhos['value'].'" style="margin-left: 20px !important;">';
		$option .= $filhos['label_1'];
		if( !empty($filhos['label_2']) ){
			$option .= $filhos['label_2'];
		}
		$option .= '</option>';
	}
}

$retorno .= '<select ' . $tabindex . ' '.$required.' '.( !empty($multiple) ? 'multiple="multiple"' : Null ).' '.$disabled.' name="'.$nome_no_banco_de_dados.''.( !empty($multiple) ? '[]' : Null ).'" id="'.$nome_no_banco_de_dados.' data-placeholder="'.___($placeholder).'" class="form-control '.$nome_no_banco_de_dados.'">';

$retorno .= '<option value=""></option>';
$retorno .= $option;
$retorno .= '</select>';
$retorno .= "<script>$('.".$nome_no_banco_de_dados."').chosen({width: '100%'});</script>";
// $retorno .= "<script>$('.".$nome_no_banco_de_dados."').chosen({width: '1450px'});</script>";