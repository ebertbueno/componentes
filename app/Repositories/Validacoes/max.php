<?php

use App\Repositories\Componentes;

if ($data[$key0] > $campoAcao[1]) {
    $statusValidacao++;
    $v = (strpos($v, '|max|') > 0 ? str_replace('|max|', $campoAcao[1], ___('' . $v)) : $v);

    $msgRetorno[] = [
        'tipo' => 'botaoToaster',
        'cor' => 'warning',
        'titulo' => ___('Atenção') . ' - ' . $validado['label'],
        'mensagem' => self::mensagensPadrao('max')
    ];
}
