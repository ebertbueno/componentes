<?php
use App\Repositories\Componentes;

$geraNumeroCarteira = '';

$matricula = str_shuffle('abcdefghijklmnopqrstuvyxwz0123456789');

$novaMatricula = substr(str_shuffle($matricula),0,$tamanho);

if(strlen($novaMatricula) == $tamanho ){
	$listMat = Model('Carteiras')::where('hash', $novaMatricula)->count();

	if($listMat > 0){
		$geraNumeroCarteira = Componentes::geraNumeroCarteira();
	}else {
		$geraNumeroCarteira = $novaMatricula;
	}
}else{
	$geraNumeroCarteira = Componentes::geraNumeroCarteira();
}
exit;