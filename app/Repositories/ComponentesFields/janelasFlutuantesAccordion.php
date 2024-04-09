<?php
$janelasFlutuantesAccordion = '<div class="col-sm-12" style="padding: 0px"><div class="box box-solid"><div class="box-body"><div class="box-group" id="accordion_'.$janela.'">';

foreach ($dados as $key => $dado) {
	$janelasFlutuantesAccordion .= '
	<div class="panel box box-inverse">
	<div class="box-header with-border">
	<h4 class="box-title">
	<a data-toggle="collapse'.$janela.'" data-parent="#accordion_'.$janela.'" href="#collapse'.$janela.'" class="collapsed" aria-expanded="false"> <i class="'.$dado['icone'].'"> </i> '.$dado['menu'].'</a>
	</h4>
	</div>
	<div id="collapse'.$janela.'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
	<div class="box-body">';

	if( $dado['link'] != 'vazio' ){
		$janelasFlutuantesAccordion .= FormularioRepositorie::formulario([
			'formulario' => 3,
			'tipo' => 'checkbox',
			'label' => $dado['menu'],
			'value' => $dado['id']
		]);
	}

	foreach ($dado['filhos'] as $key => $filhos) {
		$janelasFlutuantesAccordion .= FormularioRepositorie::formulario([
			'formulario' => 3,
			'tipo' => 'checkbox',
			'label' => $filhos['menu'],
			'value' => $filhos['id']
		]);
	}

	$janelasFlutuantesAccordion .= '</div>
	</div>
	</div>';
}

$janelasFlutuantesAccordion .= '</div></div></div></div>';