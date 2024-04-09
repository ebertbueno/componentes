<?php

$tamanhoCampo = self::calculaTamanho();

switch ($tipo) {
	case 'loja_veiculos_usados':
		$data = '<div class="row">';
		$data .= '<div class="col-lg-2">' . ___('Tags para contrato') . '</div>';
		$data .= '<div class="col-lg-10">';
		$data .= '<div class="tabs-container">';
		$data .= '<ul class="nav nav-tabs">';


		$total = 0;
		foreach (pegaDadosContrato('loja_veiculos_usados') as $key => $geral) {
			$data .= '<li style="width: ' . $tamanhoCampo . '%; text-align: center"><a class="nav-link ' . ($total === 0 ? 'active show' : Null) . '" data-toggle="tab" href="#' . deixaApenasTexto($key) . '">' . ___($key) . '</a></li>';
			$total++;
		}

		$data .= '</ul>';
		$data .= '<div class="tab-content">';
		$total = 0;
		foreach (pegaDadosContrato('loja_veiculos_usados') as $key => $geral) {
			$data .= '<div id="' . deixaApenasTexto($key) . '" class="tab-pane ' . ($total === 0 ? 'active show' : Null) . '">';
			$data .= '<div class="panel-body">';
			$data .= '<div class="row">';
			foreach ($geral as $termos) {
				$data .= '<div class="col-sm-4" style="margin-bottom: 10px;">' . copiatesteConteudo(['conteudo' => $termos['conteudo'], 'label' => $termos['label'], 'corbotao' => 'default']) . '</div>';
			}
			$data .= '</div>';
			$data .= '</div>';
			$data .= '</div>';
			$total++;
		}
		$data .= '</div>';
		$data .= '</div>';
		$data .= '</div>';
		$data .= '<div class="col-lg-12">&nbsp;</div>';
		$data .= '</div>';
		break;

	case 'nota_promissoria':
		$data = '<div class="row">';
		$data .= '<div class="col-lg-2">' . ___('Tags para contrato') . '</div>';
		$data .= '<div class="col-lg-10">';
		$data .= '<div class="tabs-container">';
		$data .= '<ul class="nav nav-tabs">';

		$total = 0;
		foreach (pegaDadosContrato('nota_promissoria') as $key => $geral) {
			$data .= '<li style="width: 33%; text-align: center"><a class="nav-link ' . ($total === 0 ? 'active show' : Null) . '" data-toggle="tab" href="#' . deixaApenasTexto($key) . '">' . ___($key) . '</a></li>';
			$total++;
		}

		$data .= '</ul>';
		$data .= '<div class="tab-content">';
		$total = 0;
		foreach (pegaDadosContrato('nota_promissoria') as $key => $geral) {
			$data .= '<div id="' . deixaApenasTexto($key) . '" class="tab-pane ' . ($total === 0 ? 'active show' : Null) . '">';
			$data .= '<div class="panel-body">';
			$data .= '<div class="row">';
			foreach ($geral as $termos) {
				$data .= '<div class="col-sm-4" style="margin-bottom: 10px;">' . copiatesteConteudo(['conteudo' => $termos['conteudo'], 'label' => ___($termos['label']), 'corbotao' => 'default']) . '</div>';
			}
			$data .= '</div>';
			$data .= '</div>';
			$data .= '</div>';
			$total++;
		}
		$data .= '</div>';
		$data .= '</div>';
		$data .= '</div>';
		$data .= '<div class="col-lg-12">&nbsp;</div>';
		$data .= '</div>';
		break;

	default:
		$data = '';
		break;
}
return $data;
