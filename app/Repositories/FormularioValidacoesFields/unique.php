<?php
use App\Repositories\Componentes;

$campoAcao = explode(',',$campoAcao[1]);
if(!empty($data['id'])){
	$consulta = DB::table($campoAcao[0])->where($campoAcao[1], $data[$key])->where('id', '<>', $data['id'])->count();
} else {
	$consulta = DB::table($campoAcao[0])->where($campoAcao[1], $data[$key])->count();
}

if( $consulta != 0 ){
	$statusValidacao .= 1;
	$msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster','cor' => 'warning','titulo' => ___('Atenção').' - '.$placeholder,'texto' => ___($validado2)]);
}