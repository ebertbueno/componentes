<?php
use App\Repositories\Componentes;

// 'password|senha'=>['equal:senha,re-senha'=>'senhas_sao_diferentes',],

$campoAcao = explode(',',$campoAcao[1]);
if ( $data[$campoAcao[0]] != $data[$campoAcao[1]] ) {
	$statusValidacao .= 1;
	$msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster','cor' => 'warning','titulo' => ___('Atenção').' - '.$placeholder,'texto' => ___($validado2)]);
}