<?php
use App\Repositories\Componentes;

$acao = explode('|',$campoAcao[1]);
$valorPassado = $data[$key];

if( $acao[0] === 'hoje' ){
	$campo = date('Y-m-d');
} else {
	$campo = formataData($acao[0],'Y-m-d');
}

if ( calculaDiferencaDias($campo,$valorPassado) < 0 ) {
	$statusValidacao .= 1;
	$msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster','cor' => 'warning','titulo' => ___('Atenção').' - '.$placeholder,'texto' => ___($validado2)]);
}