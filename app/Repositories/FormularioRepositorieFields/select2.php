<?php

use App\Repositories\ConsultasRepositore;

$option = '';
foreach (ConsultasRepositore::ConsultasRepositore($tabela_relacional) as $dado) {
	if (is_array($valor_inicial)) {
		$selecionado = (in_array((int)$dado['value'], $valor_inicial) ? 'selected="selected"' : Null);
	} else {
		$selecionado = ($valor_inicial === $dado['value'] ? 'selected="selected"' : Null);
	}
	$option .= '<option ' . $selecionado . ' value="' . $dado['value'] . '">';
	$option .= $dado['label_1'];
	$option .= (isset($dado['label_2']) ? ' - ' . $dado['label_2'] : Null);
	$option .= (isset($dado['label_3']) ? ' - ' . $dado['label_3'] : Null);
	$option .= '</option>';
}

$retorno = '<div class="form-group row" style="width: 100%;">';
$retorno .= '<label class="col-sm-' . $tamLabel . ' col-form-label">' . $required_label . ___($label) . '</label>';
$retorno .= '<div class="col-sm-' . $tamDiv . '">';
$retorno .= '<div class="input-group m-b">';
$retorno .= '<select ' . $tabindex . ' ' . $required . ' ' . (!empty($multiple) ? 'multiple="multiple"' : Null) . ' ' . $disabled . ' name="' . $nome_no_banco_de_dados . '' . (!empty($multiple) ? '[]' : Null) . '" id="' . $nome_no_banco_de_dados . ' data-placeholder="' . ___($placeholder) . '" class="form-control ' . $nome_no_banco_de_dados . '">';
$retorno .= '<option value=""></option>';
$retorno .= $option;
$retorno .= '</select>';
$retorno .= "<script>$('." . $nome_no_banco_de_dados . "').chosen({width: '100%'});</script>";
$retorno .= $campoAvulso;
$retorno .= '</div>';
$retorno .= $msg_base;
$retorno .= '</div>';
$retorno .= '</div>';
