<?php
$mostraIconeA = '<div class="input-group-prepend" style="height: 35px;">';
$mostraIconeA .= '<span class="input-group-addon">';
switch ($icone['tipo']) {
	case 'imagem':
	$mostraIconeA .= '<img src="'.$icone['arquivo'].'" style="height: 15px !important;">';
	break;

	case 'letra':
	$mostraIconeA .= '<span style="font-weight: bold">'.$icone['arquivo'].'</span>';
	break;

	default:
	$mostraIconeA .= '<i class="'.$icone['arquivo'].'"></i>';
	break;
}
$mostraIconeA .= '</span></div>';