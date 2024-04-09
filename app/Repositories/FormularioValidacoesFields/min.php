<?php
use App\Repositories\Componentes;

// 'min:3' => 'campo_deve_ter_minimo_de_|min|_caracteres',
$resultado = ( $data[$key] >= $campoAcao[1] ? 0 : -1 );
if( $resultado < 0 ){
	$statusValidacao .= 1;
	$validado2 = ( strpos($validado2, '|min|') > 0 ? str_replace('|min|', $campoAcao[1], ___(''.$validado2)) : $validado2 );
	$msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster','cor' => 'warning','titulo' => ___('Atenção').' - '.$placeholder,'texto' => $validado2]);
}