<?php
$mostraIconeD = '<div class="input-group-append" style="height: 35px;">';
$mostraIconeD .= '<span class="input-group-addon">';
$mostraIconeD .= ( !empty($iconeD['url']) ? '<a onclick="'.trataUrlparaFuncao($iconeD['url']).'" style="cursor: pointer">' : Null );
switch ($iconeD['tipo']) {
	case 'imagem':
	$mostraIconeD .= '<img src="'.$iconeD['arquivo'].'" style="height: 15px !important;">';
	break;

	case 'letra':
	$mostraIconeD .= '<span style="font-weight: bold">'.$iconeD['arquivo'].'</span>';
	break;

	default:
	$mostraIconeD .= '<i class="'.$iconeD['arquivo'].'"></i>';
	break;
}
$mostraIconeD .= ( !empty($iconeD['url']) ? '</a>' : Null );
$mostraIconeD .= '</span>';
$mostraIconeD .= '</div>';