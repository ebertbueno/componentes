<?php
use App\Repositories\Componentes;

$geraChavePin = '';

$matCli = rand(1,999999);
if(strlen($matCli) == $tamanho){
	$listMat = Model('PinSolicitados')::where('pin', $matCli)->count();

	if($listMat > 0){
		$geraChavePin = Componentes::geraChavePin();
	}else {
		$geraChavePin = $matCli;
	}
}else{
	$geraChavePin = Componentes::geraChavePin();
}
exit;