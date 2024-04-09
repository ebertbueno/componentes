<?php
use App\Repositories\Componentes;

if (!empty($data[$key])) {
	$statusValidacao .= (!filter_var($data[$key], FILTER_VALIDATE_EMAIL) ? 1 : 0);
	if ((int)$statusValidacao === 1) {
		$msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'titulo' => ___('Atenção') . ' - ' . $placeholder, 'texto' => ___($validado2)]);
	}
}