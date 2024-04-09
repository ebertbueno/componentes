<?php

$nome_no_banco_de_dados = $data[$validado['nome_no_banco_de_dados']];
if (strlen($nome_no_banco_de_dados) === 0) {
    $statusValidacao++;
    $msgRetorno[] = [
        'tipo' => 'botaoToaster',
        'cor' => 'warning',
        'titulo' => ___('Atenção') . ' - ' . $validado['label'],
        'mensagem' => self::mensagensPadrao('required')
    ];
}
