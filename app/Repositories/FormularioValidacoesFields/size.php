<?php
use App\Repositories\Componentes;

if( strlen($data[$key]) <= $campoAcao[1] ){
	$statusValidacao .= 1;
	$msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster','cor' => 'warning','titulo' => ___('Atenção').' - '.$placeholder,'texto' => ___($validado2)]);
}