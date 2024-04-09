<?php
use App\Repositories\Componentes;

// 'nome|nome'=>['required'=>'Campo obrigatório'],

$statusValidacao .= ( empty($data[$key]) ? 1 : 0 );
if( (int)$statusValidacao === 1 ){
	$msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster','cor' => 'warning','titulo' => ___('Atenção').' - '.$placeholder,'texto' => ___($validado2)]);
}