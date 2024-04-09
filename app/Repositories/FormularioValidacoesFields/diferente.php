<?php
use App\Repositories\Componentes;

if ( ($data[$key]*1) === ($data[$campoAcao[1]]*1) ) {
	$statusValidacao .= 1;
	$msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster','cor' => 'warning','titulo' => ___('Atenção').' - '.$placeholder,'texto' => ___($validado2)]);
}