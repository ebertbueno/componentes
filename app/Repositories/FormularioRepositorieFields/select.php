<?php

use App\Repositories\ConsultasRepositore;

$option = '<option value="vazio">' . ___('Selecione') . '</option>';
foreach (ConsultasRepositore::ConsultasRepositore($tabela_relacional) as $dado) {
	if (is_array($valor_inicial)) {
		$selecionado = (in_array((int)$dado['value'], $valor_inicial) ? 'selected' : Null);
	} else {
		$selecionado = ($valor_inicial === $dado['value'] ? 'selected="selected"' : Null);
	}
	$option .= '<option ' . $selecionado . ' value="' . $dado['value'] . '">';
	$option .= ___($dado['label_1']);
	$option .= (isset($dado['label_2']) ? ' - ' . ___($dado['label_2']) : Null);
	$option .= (isset($dado['label_3']) ? ' - ' . ___($dado['label_3']) : Null);
	$option .= (isset($dado['label_4']) ? ' - ' . ___($dado['label_4']) : Null);
	$option .= '</option>';
}

$retorno .= '<select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="' . ___('Selecione') . '" name="' . $nome_no_banco_de_dados . '" ' . $required . ' ' . $disabled . ' id="' . $nome_no_banco_de_dados . '>';
$retorno .= '<option value="vazio">' . ___('Selecione') . '</option>';
$retorno .= $option;
$retorno .= '</select>';
