<?php
use App\Repositories\Componentes;

$campoAcao = explode(',',$campoAcao[1]);
$consulta = DB::table($campoAcao[0])->where($campoAcao[1], $data[$key])->count();

if( (int)$consulta === 0 ){
	$statusValidacao .= 1;
	$msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster','cor' => 'warning','titulo' => ___('Atenção').' - '.$placeholder,'texto' => $key . ' ' . ___($validado2)]);
}