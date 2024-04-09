<?php
// $option = '';
// $valor_relacional = ConsultasRepositore::ConsultasRepositore($tabela_relacional);
// foreach($valor_relacional  as $dado ){
// 	$option .= '<optgroup label="'.$dado['label_1'].'">';
// 	foreach($dado[$chave_tabela_relacional] as $filhos ){
// 		$selecionado = ( $valor_inicial === $filhos['value'] ? 'selected="selected"' : 'vazio' );
// 		$option .= '<option '.$selecionado.' value="'.$filhos['value'].'">'.$filhos['label_1'].( isset($filhos['label_2']) ? ' - ' . $filhos['label_2'] : '' ).'</option>';
// 	}
// 	$option .= '</optgroup>';
// }

// $retorno .= '<select ' . $tabindex . ' '.$campoLivre.' '.$disabled.' style="width: 100%" '.( $tipo === 'select_multiple' ? 'multiple' : ''  ).' '.$required.' name="'.$nome_no_banco_de_dados.''.( $tipo === 'select_multiple' ? '[]' : ''  ).'" id="'.$nome_no_banco_de_dados.'" class="js-example-basic-single '.$cssAdicionalInput.'" style="width:10px !important;"><option value=""></option>'.$option.'</select>'.$msg_complementar;

$retorno = 'optgroup';
