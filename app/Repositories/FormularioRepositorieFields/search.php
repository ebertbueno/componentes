<?php

use App\Repositories\ConsultasRepositore;

$retorno = 'search';

// $option = '';
// foreach (ConsultasRepositore::ConsultasRepositore($tabela_relacional) as $dado) {
// 	$selecionado = ($valor_inicial === $dado['value'] ? 'selected="selected"' : '');

// 	$campos = $dado['label_1'];
// 	$campos .= (!empty($dado['label_2']) ? ' - ' . $dado['label_2'] : Null);
// 	$campos .= (!empty($dado['label_3']) ? ' - ' . $dado['label_3'] : Null);
// 	$campos .= (!empty($dado['label_4']) ? ' - ' . $dado['label_4'] : Null);

// 	$option .= '<option ' . $selecionado . ' value="' . $campos . '" class="form-control">' . $campos . '</option>';
// }

// $retorno = '<div class="form-group row" style="width: 100%;">';
// $retorno .= '<label class="col-sm-' . $tamLabel . ' col-form-label">' . $required_label . ___($label) . '</label>';
// $retorno .= '<div class="col-sm-' . $tamDiv . '">';
// $retorno .= '<div class="input-group m-b">';
// $retorno .= '<input ' . $tabindex . ' ' . $campoLivre . ' autocomplete="off" ' . $required . ' ' . $readonly . ' value="' . $valor_inicial . '" ' . $minlength . ' ' . $maxlength . ' name="' . $nome_no_banco_de_dados . '" id="' . $nome_no_banco_de_dados . '" type="search" class="' . $mascara . ' ' . $cssAdicionalInput . '" value="' . $valor_inicial . '" list="busca_' . $nome_no_banco_de_dados . '">';
// $retorno .= $msg_complementar;
// $retorno .= '<datalist id="busca_' . $nome_no_banco_de_dados . '">';
// $retorno .= '<option class="form-control" value="">Digite aqui</option>';
// $retorno .= $option;
// $retorno .= '</datalist>';
// $retorno .= $msg_complementar;
// $retorno .= $campoAvulso;
// $retorno .= '</div>';
// $retorno .= $msg_complementar;
// $retorno .= '</div>';
// $retorno .= '</div>';