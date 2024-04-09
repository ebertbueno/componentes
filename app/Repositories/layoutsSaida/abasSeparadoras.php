<?php

$tamanho = count($data);
$larguraQuadro = round(100 / $tamanho, 5);
if ($tamanho * $larguraQuadro > 100) {
	$totalCalculado = $tamanho * $larguraQuadro;
	$larguraQuadro = round((100 - ($totalCalculado - 100)) / $tamanho, 5);
}

$tamLabel = (!empty($data['tamLabel']) ? $data['tamLabel'] : 0);
$tamDiv = (!empty($data['tamDiv']) ? $data['tamDiv'] : 12);
$label = (!empty($data['label']) ? $data['label'] : '');

$retorno = '<div class="row">';
if ($tamLabel > 0) {
	$retorno .= '<div class="col-lg-' . $tamLabel . '">';
	$retorno .= ___($label);
	$retorno .= '</div>';
}
$retorno .= '<div class="col-lg-' . $tamDiv . '">';
$retorno .= '<div class="tabs-container">';
$retorno .= '<ul class="nav nav-tabs" role="tablist">';

// topos das abas
foreach ($data as $key => $datas) {
	$retorno .= '<li style="width: ' . $larguraQuadro . '% !important;"><a class="nav-link ' . ($key === 0 ? 'active' : Null) . ' text-center" data-toggle="tab" href="#tab-' . $key . '">';
	$retorno .= '<i class="' . $datas['icone'] . '"></i><br>';
	$retorno .= ___($datas['label']);
	$retorno .= '</a></li>';
}
// topos das abas

$retorno .= '</ul>';
$retorno .= '<div class="tab-content">';


// conteudo das abas
foreach ($data as $subkey => $datas) {
	$retorno .= '<div role="tabpanel" id="tab-' . $subkey . '" class="tab-pane ' . ($subkey === 0 ? 'active' : Null) . '">';
	$retorno .= '<div class="panel-body">';

	foreach ($datas['formulario'] as $formulario) {
		$retorno .= $formulario;
	}

	$retorno .= '</div>';
	$retorno .= '</div>';
}
// conteudo das abas


$retorno .= '</div>';
$retorno .= '</div>';
$retorno .= '</div>';
$retorno .= '</div>';
$retorno .= '<div class="row">';
$retorno .= '<div class="col-lg-12">&nbsp;</div>';
$retorno .= '</div>';

return $retorno;
