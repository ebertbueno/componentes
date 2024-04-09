<?php
use App\Repositories\Componentes;

$matCli = rand(1,999999999999);
if(strlen($matCli) == 12 && $matCli != 9999){
	$listMat = Model('Users')::where('matricula', $matCli)->count();

	if($listMat > 0){
		$geraNumeroMatricula = Componentes::geraNumeroMatricula();
	}else {
		$geraNumeroMatricula = 'M'.$matCli;
	}
}else{
	$geraNumeroMatricula = Componentes::geraNumeroMatricula();
}
exit;