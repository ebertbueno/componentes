<?php

use App\Repositories\Componentes;

if (!empty($data[$key])) {
    $explode = explode('-', $data[$key]);
    $dia = $explode[2];
    $mes = $explode[1];
    $ano = $explode[0];

    if (!checkdate($mes, $dia, $ano)) {
        $statusValidacao .= 1;
        $msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'titulo' => ___('Atenção') . ' - ' . $placeholder, 'texto' => ___($validado2)]);
    }
}