<?php
// $retorno = '<div class="row">';
// foreach (ConsultasRepositore::ConsultasRepositore($tabela_relacional) as $dado) {
// 	$selecionado = ($valor_inicial === $dado['value'] ? 'checked="checked"' : Null);

// 	$retorno .= '<div class="col-md-3" style="border:1px solid #e6e6e6 !important; border-radius: 5px !important; max-width: 18.7% !important; margin: 10px !important;">';
// 	$retorno .= '<label id="' . $dado['value'] . '" name="' . $dado['value'] . '" value="' . $dado['value'] . '">';
// 	$retorno .= '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
// 	$retorno .= '<tr><td style="height: 35px !important;">' . $dado['label_1'] . '<td></tr>';
// 	$retorno .= '<tr><td style="height: 200px !important; overflow: hidden !important; vertical-align: text-top !important; ">
// 								<img src="' . verificaImagemSistem($dado['imagem']) . '" style="height: auto !important; width: 100% !important; padding: 10px !important; float: left !important; border:1px solid #e6e6e6 !important; border-radius: 5px !important; ">
// 								</td></tr>';
// 	$retorno .= '<tr><td style="height: 35px !important;">
// 								<input ' . $selecionado . ' type="radio" name="' . $nome_no_banco_de_dados . '" id="' . $nome_no_banco_de_dados . '" value="' . $dado['value'] . '">
// 								<td></tr>';
// 	$retorno .= '</table>';
// 	$retorno .= '</label>';
// 	$retorno .= '</div>';
// }
// $retorno .= '</div>';

$retorno = 'quadro_imagem_radio';